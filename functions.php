<?php

function checkError_Input($data, $type, $errorMessage){
    $arrError = [];
    if(!empty($data)){
        switch ($type) {
            case 'text':
                if(is_string($data)) $arrError['text'] .= $errorMessage;
                break;

            case 'email':
                if(!filter_var($data, FILTER_VALIDATE_EMAIL)) $arrError[] .= $errorMessage;
                break;

            case 'password':
                /** Dùng jquery hiển thị tips nhập password
                 * mk phải có chữ cái đầu tiên viết hoa
                 * mk phải trong khoảng [5 - 20] ký tự
                 * mk phải có ít nhất 1 số
                 */
                

        }
    }
}
