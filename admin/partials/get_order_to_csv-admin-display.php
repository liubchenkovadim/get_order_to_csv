<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
if(isset($_POST["go"])) {
    if (!empty($_POST["do"]) || !empty($_POST["ot"])) {
        $arg = [
            'limit' => 10,
            'date_before' => $_POST["do"],
            'date_after' => $_POST["ot"],
        ];
        $orders = wc_get_orders($arg);

        $result = [];
        if (!empty($orders)) {
            foreach ($orders as $key => $order) {
                $data = $order->data['billing'];
                $result[$key]['name'] = mb_convert_encoding($data['first_name'], 'UTF-8');
                $result[$key]['phone'] = $data['phone'];
                $result[$key]['email'] = $data['email'];

            }
            if (!empty($result)) {
                $file = GET_ORDER_TO_CSV_CACHE_DIR . "order-info.csv";
                if (file_exists($file)) {
                    unlink($file);
                }
                file_put_contents($file, "Name, Phone, Email" . PHP_EOL, FILE_APPEND | LOCK_EX);
                foreach ($result as $item) {
                    file_put_contents($file,  $item['name'] . "," . $item['phone'] . "," . $item['email'] . PHP_EOL, FILE_APPEND | LOCK_EX);
                }
                $res_file = plugins_url('get_order_to_csv').'/cache/order-info.csv';

            } else {
                echo 'В данном диапазоне нет заказов';
            }
        } else {
            echo 'В данном диапазоне нет заказов';
        }
    } else {
        echo 'Укажите даты для поиска';
    }
}


/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://test.com
 * @since      1.0.0
 *
 * @package    Get_order_to_csv
 * @subpackage Get_order_to_csv/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

        <form method="POST">
            <table class="form-table">
                <tr>
                    <td> C </td>
                    <td><input type="date" name="ot" required></td>
                </tr>
                <tr>
                    <td> До </td>
                    <td><input type="date" name="do" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Выгрузить" name="go">

                    </td>
                </tr>
                <?php if(isset($file)  && file_exists($file)){ ?>
                    <tr>
                        <td> Сылка на файл:</td>
                        <td><a href="<?php echo $res_file ; ?>" id="click"><?php echo $res_file ; ?></a> </td>
                    </tr>
                    <script>
                        $('#click').trigger('click');
                    </script>
                <?php } ?>
            </table>

        </form>

