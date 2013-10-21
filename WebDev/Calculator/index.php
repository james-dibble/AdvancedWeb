<?php
function __autoload($class_name) {
    include $class_name . '.class.php';
}

class FormHelper{
    public static function GetPostVal($key){
        if(isset($_POST[$key])){
            return $_POST[$key];
        }
        
        return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operator = FormHelper::GetPostVal('operator');
    $left = FormHelper::GetPostVal('number1');
    $right = FormHelper::GetPostVal('number2');
    $calculator = new Calculator($left, $right, $operator);
    $result = $calculator->Calculate();
}
?>
<html>
    <body>
        <form action="/webdev/calculator/" method="POST">
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
