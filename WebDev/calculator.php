<?php
class FormHelper{
    public static function GetPostVal($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }
        
        return null;
    }
}

class Calculator {
    public static function Calculate($operator, $number1, $number2){
        switch ($operator){
            case '+':
                return Calculator::Add($number1, $number2);
            case '-':
                return Calculator::Subtract($number1, $number2);
            case 'x':
                return Calculator::Multiply($number1, $number2);
            case '/':
                return Calculator::Divide($number1, $number2);
            default:
                throw new InvalidArgumentException('Undefined operator used.');
        }
    }
    
    private static function Add($number1, $number2) {
        return $number1 + $number2;
    }

    private static function Subtract($number1, $number2) {
        return $number1 - $number2;
    }

    private static function Multiply($number1, $number2) {
        return $number1 * $number2;
    }

    private static function Divide($number1, $number2) {
        return $number1 / $number2;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operator = FormHelper::GetPostVal('operator');
    $left = FormHelper::GetPostVal('number1');
    $right = FormHelper::GetPostVal('number2');
    $result = Calculator::Calculate($operator, $left, $right);
}
?>
<html>
    <body>
        <form action="calculator.php" method="POST">
            <input type="test" name="number1" value="<?php echo(FormHelper::GetPostVal('number1')); ?>" /><br />
            <span id="operator"><?php echo(FormHelper::GetPostVal('operator')); ?></span><br />
            <input type="test" name="number2" value="<?php echo(FormHelper::GetPostVal('number2')); ?>" /><br />
            <input type="hidden" name="operator" value="<?php echo(FormHelper::GetPostVal('operator')); ?>" />
            <button type="button" data-operator="+">Add</button>
            <button type="button" data-operator="-">Subtract</button>
            <button type="button" data-operator="x">Multiply</button>
            <button type="button" data-operator="/">Divide</button><br />
            <button type="submit">Calculate</button>
        </form>
        <span><?php if (isset($result)) echo($result) ?></span>
    </body>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('button[data-operator]').click(function(){
               $('input[name="operator"]').val($(this).data('operator'));
               $('#operator').html($(this).data('operator'));
            });
        });
    </script>
</html>
