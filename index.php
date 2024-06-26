<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>税込み計算電卓</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .calculator {
    width: 400px;
    margin: 50px auto;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  #display {
    height: 50px; 
    font-size: 24px; 
    text-align: right; 
    padding: 5px; 
    margin-bottom: 10px;
  }
  .calculator input[type="text"] {
    width: calc(100% - 20px);
    height: 40px;
    font-size: 20px;
    text-align: right;
    margin-bottom: 10px;
    padding: 5px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
  }
  .calculator input[type="button"] {
    width: calc(25% - 30px);
    height: 50px;
    margin: 5px;
    font-size: 20px;
  }
  .calculator input[type="button"].equals {
    width: 154px;
  }
</style>
</head>
<body>
<div class="calculator">
<form action="update.php" method="post" id="calcForm">
    <input type="text" id="display" name="price" class="w-full mb-4 px-2 py-1 border rounded" readonly>
    <button class="btn" onclick="update()">計上</button>
</form>
  <br> 
  <input type="button" value="AC" onclick="clearDisplay()" class="equals">
  <input type="button" value="税込み" onclick="calculateTax(this)" class="equals">
  <br>
  <input type="button" value="7" onclick="addToDisplay('7')">
  <input type="button" value="8" onclick="addToDisplay('8')">
  <input type="button" value="9" onclick="addToDisplay('9')">
  <input type="button" value="×" onclick="addToDisplay('*')">
  <br>
  <input type="button" value="4" onclick="addToDisplay('4')">
  <input type="button" value="5" onclick="addToDisplay('5')">
  <input type="button" value="6" onclick="addToDisplay('6')">
  <input type="button" value="+" onclick="addToDisplay('+')">
  <br>
  <input type="button" value="1" onclick="addToDisplay('1')">
  <input type="button" value="2" onclick="addToDisplay('2')">
  <input type="button" value="3" onclick="addToDisplay('3')">
  <input type="button" value="=" onclick="calculate()">
  <br>
  <input type="button" value="0" onclick="addToDisplay('0')">
  <input type="button" value="売上" onclick="sales()">
  <br>
</div>
<script>
var taxButtonClicked = false;

function addToDisplay(value) {
  // ディスプレイに数字がない場合に、+ ボタンと × ボタンを入力不可にする
  if (value === '+' || value === '*') {
    if (document.getElementById("display").value === "") {
      return;
    }
  }
  document.getElementById("display").value += value;
  // ディスプレイの内容が変更されたら、税込みボタンを有効化する
  taxButtonClicked = false;
}

function clearDisplay() {
  document.getElementById("display").value = "";
  taxButtonClicked = false; // ディスプレイがクリアされたら、税込みボタンを有効化する
}

function calculate() {
  var expression = document.getElementById("display").value;
  if (expression === "") { // 入力フィールドが空の場合
    return; // 何もせずに関数を終了する
  }
  var result = eval(expression);
  document.getElementById("display").value = result;
  // taxButtonClicked = false; // ディスプレイの内容が変更されたら、税込みボタンを有効化する
}

function calculateTax(button) {
  if (!taxButtonClicked) { // ボタンがクリックされたことがない場合のみ処理を行う
    var expression = document.getElementById("display").value;
    if (expression === "") { // 入力フィールドが空の場合
      return; // 何もせずに関数を終了する
    }
    var result = eval(expression);
    var taxIncludedPrice = result * 1.1; // 税率10%
    document.getElementById("display").value = taxIncludedPrice.toFixed(0);
    button.disabled = true; // ボタンを無効化
    taxButtonClicked = true; // ボタンがクリックされたことを記録
  }
}

function sales() {
  var expression = document.getElementById("display").value;
  if (expression === "") { // 入力フィールドが空の場合
    return; // 何もせずに関数を終了する
  }
  var result = eval(expression);
  alert("売り上げは " + result.toFixed(2) + " 円です。");
}

function record() {
  var expression = document.getElementById("display").value;
  if (expression === "") { // 入力フィールドが空の場合
    return; // 何もせずに関数を終了する
  }
  document.getElementById("calcForm").submit(); // フォームを送信
}
</script>

</body>
</html>