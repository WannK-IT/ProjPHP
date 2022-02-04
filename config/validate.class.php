<?php
class Validate
{
    private $source = [];
    private $element = [];
    private $error = [];
    private $result = [];

    public function __construct($dataValidate)
    {
        $this->source = $dataValidate;
    }

    public function getErrors()
    {
        return $this->error;
    }

    public function getResults()
    {
        return $this->result;
    }

    /*  -- NOTE --
     *  var  : var_name in $_POST['var_name']
     *  type : type of validate
     */
    public function addElement($var, $type, $min = 0, $max = 0)
    {
        $this->element[$var] = ['type' => $type, 'min' => $min, 'max' => $max];
        // return $this;

    }

    public function run()
    {
        if (!checkEmpty($this->element)) {
            foreach ($this->element as $key => $value) {
                switch ($value['type']) {
                    case 'string':
                        $this->validateString($key, $value['min'], $value['max']); //chỉ validate chữ
                        break;

                    case 'string_number':
                        $this->validateString($key, $value['min'], $value['max'], true); //chấp nhận validate chữ và số
                        break;

                    case 'email':
                        $this->validateEmail($key);
                        break;

                    case 'password':
                        $this->validatePassword($key,  $value['min'], $value['max']);
                        break;

                    default:
                        return;
                        break;
                }

                if (!array_key_exists($key, $this->error)) {
                    $this->result[$key] = $this->source[$key];
                }
            }
        }
    }

    // Validate String
    public function validateString($data, $min = 0, $max = 0, $allowNumber = false)
    {
        if (checkEmpty($this->source[$data])) {
            $this->error[$data] = 'không được để trống!';
        } elseif (checkLength($this->source[$data], $min, $max)) {
            $this->error[$data] = sprintf('phải trong khoảng %s - %s ký tự!', $min, $max);
        } elseif ($allowNumber == false) {
            if (preg_match('/[\'^£0-9$%&*()`}{@#~?><>,.|=_+¬-]/', $this->source[$data]))
                $this->error[$data] =  'không được chứa các ký tự đặc biệt và số!';
        } else {
            if (preg_match('/[\'^£$%&*()`}{@#~?><>,.|=_+¬-]/', $this->source[$data]))
                $this->error[$data] = 'không được chứa các ký tự đặc biệt!';
        }
    }

    // Validate Email
    public function validateEmail($data)
    {
        if (checkEmpty($this->source[$data])) {
            $this->error[$data] = 'Email không được để trống!';
        } elseif (!filter_var($this->source[$data], FILTER_VALIDATE_EMAIL)) {
            $this->error[$data] = 'Email không hợp lệ!';
        }
    }

    // Validate Password
    public function validatePassword($data, $min = 0, $max = 0)
    {
        if (checkEmpty($this->source[$data])) {
            $this->error[$data] = 'không được để trống!';
        } elseif (checkLength($this->source[$data], $min, $max)) {
            $this->error[$data] = sprintf('phải nằm trong khoảng %s - %s ký tự!', $min, $max);
        } else {
            if (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/', $this->source[$data]))
                $this->error[$data] = 'gồm ký tự hoa, ký tự thường và số!';
        }
    }

}
