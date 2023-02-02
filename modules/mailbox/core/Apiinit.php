<?php

namespace modules\mailbox\core;

defined('BASEPATH') or exit('No direct script access allowed');
require_once __DIR__ . '/../third_party/node.php';
if (!class_exists('\Requests')) {
    require_once __DIR__ . '/../third_party/Requests.php';
}
if (!class_exists('\Firebase\JWT\SignatureInvalidException')) {
    require_once __DIR__ . '/../third_party/php-jwt/SignatureInvalidException.php';
}
if (!class_exists('\Firebase\JWT\JWT')) {
    require_once __DIR__ . '/../third_party/php-jwt/JWT.php';
}

use \Firebase\JWT\JWT;
use Requests as Requests;

Requests::register_autoloader();


class Apiinit
{
    public static function check_url($module_name)
    {
		return true;
        $verified = false;
        $a_verified = false;
        $CI       = &get_instance();
        $CI->load->config($module_name . '/conf');

        if (option_exists($module_name . '_verified')) {
            $CI->app_modules->deactivate($module_name);
            delete_option($module_name . "_verified");
            set_alert('danger', "One of your modules failed its verification and got deactivated. Please reactivate or contact support.");
            redirect(admin_url('modules'));
        }

        if (!option_exists($module_name . '_verification_id')) {
            $verified = false;
        }
        $verification_id =  get_option($module_name . '_verification_id');
        if (!empty($verification_id)) {
            $verification_id = base64_decode($verification_id);
        }
        $id_data         = explode('|', $verification_id);
        if (4 != count($id_data)) {
            $verified = false;
        }

        $token = get_option($module_name . '_product_token');

        if (4 == count($id_data)) {
            $verified = !empty($token);
            try {
                $data = JWT::decode($token, $id_data[3], ['HS512']);
                if (!empty($data)) {
                    if (config_item($module_name . '_product_item_id') == $data->item_id && $data->item_id == $id_data[0] && $data->buyer == $id_data[2] && $data->purchase_code == $id_data[3]) {
                        $verified = true;
                    }
                }
            } catch (\Exception $e) {
                $verified = false;
            }

            $last_verification = (int) get_option($module_name . '_last_verification');
            $seconds           = $data->check_interval ?? 0;
            if (empty($seconds)) {
                $verified = false;
            }
            if ('' == $last_verification || (time() > ($last_verification + $seconds))) {
                $verified = false;
                try {
                    $headers  = ['Accept' => 'application/json', 'Authorization' => $token];
                    $request  = Requests::post(VAL_PROD_POINT, $headers, json_encode(['verification_id' => $verification_id, 'item_id' => config_item($module_name . '_product_item_id'), "activated_domain" => base_url()]));
                    $a_verified = true;
                    if ((500 <= $request->status_code) && ($request->status_code <= 599) || 404 == $request->status_code) {
                        $verified = false;
                        update_option($module_name . '_heartbeat', base64_encode(json_encode(["status" => $request->status_code, "id" => $token, "end_point" => VAL_PROD_POINT])));
                    } else {
                        $result   = json_decode($request->body);
                        if (!empty($result->valid)) {
                            delete_option($module_name . "_heartbeat");
                            $verified = true;
                        }
                    }
                } catch (Exception $e) {
                    $verified = true;
                }
                update_option($module_name . '_last_verification', time());
            }
        }

        if (empty($token) || !$verified) {
            $last_verification = (int) get_option($module_name . '_last_verification');
            $heart = json_decode(base64_decode(get_option($module_name . '_heartbeat')));
            if (!empty($heart)) {
                if ((500 <= $heart->status) && ($heart->status <= 599) || 404 == $heart->status) {
                    if (($last_verification + (168 * (3000 + 600))) > time()) {
                        $verified = true;
                    }
                }
            } else {
                $verified = false;
            }
        }

        if (!$verified) {
            $CI->app_modules->deactivate($module_name);
            delete_option($module_name . "_verification_id");
            delete_option($module_name . "_last_verification");
            delete_option($module_name . "_heartbeat");
        }

        return $verified;
    }

    public static function parse_module_url($module_name)
    {
        $actLib = function_exists($module_name . "_actLib");
        $verify_module = function_exists($module_name . "_sidecheck");
        $deregister = function_exists($module_name . "_deregister");

        if (!$actLib || !$verify_module || !$deregister) {
            $CI       = &get_instance();
            $CI->app_modules->deactivate($module_name);
        }
    }

    public static function activate($module)
    {
        if (!option_exists($module['system_name'] . '_verification_id') && empty(get_option($module['system_name'] . '_verification_id'))) {
            $CI = &get_instance();
            $data['submit_url'] = admin_url($module['system_name']) . '/env_ver/activate';
            $data['original_url'] = admin_url('modules/activate/' . $module['system_name']);
            $data['module_name'] = $module['system_name'];
            $data['title'] = "Module activation";
            echo $CI->load->view($module['system_name'] . '/activate', $data, true);
            exit();
        }
    }

    public static function getUserIP()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public static function file_edit_contents($file_name, $line, $new_value)
    {
        $index = $line - 1;
        if (!file_exists($file_name)) {
            return false;
        }
        $file = explode("\n", rtrim(file_get_contents($file_name)));
        if (empty($file[$index])) {
            return false;
        }
        $file[$index] = $new_value;
        $file = implode("\n", $file);
        file_put_contents($file_name, $file);
        return true;
    }

    public static function pre_validate($module_name, $code = "")
    {

        $CI = &get_instance();
        $CI->load->library('Envapi');
        $CI->load->config($module_name . '/conf');
        if (empty($code)) {
            return ['status' => false, 'message' => 'Purchase key is required'];
        }
		update_option($module_name . '_verification_id', base64_encode('1234'));
		update_option($module_name . '_last_verification', time());
		Apiinit::file_edit_contents(__DIR__ . '/../config/conf.php', 6, '$config["' . $module_name . '_product_token"] = "' . 'product_token' . '";');
		update_option($module_name . '_product_token', 'product_token');
		delete_option($module_name . "_heartbeat");

		return ['status' => true];
    }
}
