<?php
//Обычно я не пишу комментарии в коде.
function reverseWords($str): string
{
    //разбиваем строку по всем символам, которые не являются буквами, цифрами или одиночной кавычкой, помещаем в массив строк
    $words = preg_split("/([^\w'])/", $str, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    //создаем пустой массив для будущих реверсивных строк
    $reversedWords = [];


    foreach ($words as $word) {
        //поиск латинских букв и замена
        $reversedWord = preg_replace_callback("/[a-zA-Z]+/", function($match) {
            //преобразуем строку в массив букв
            $chars = str_split($match[0]);
            //меняем порядок букв в реверсивном порядке и приводим в нижний регистр
            $reversedChars = array_map('strtolower', array_reverse($chars));

            foreach ($chars as $index => $char) {
                //обращаемся к оригинальной строке и проверяем есть ли буквы в верхнем регистре
                if (ctype_upper($char)) {
                    //тогда буква с таким же индексом в реверссивном массиве вернется в верхнем регистре
                    $reversedChars[$index] = strtoupper($reversedChars[$index]);
                }
            }
            //Объединяет элементы массива в строку
            return implode('', $reversedChars);
        }, $word);

        //Собираем слова в массив
        $reversedWords[] = $reversedWord;
    }
    //Объединяет элементы массива в строку
    return implode('', $reversedWords);
}

function testReverseWords(): void
{
    //массив тестовых строк до и после преобразования
    $tests = [
        ["Cat", "Tac"],
        ["houSe", "esuOh"],
        ["third-part", "driht-trap"],
        ["can`t", "nac`t"],
        ["cat,", "tac,"],
        ["is 'cold' now", "si 'dloc' won"]
    ];


    for ($i = 0; $i < count($tests); $i++) {
        //выбираем тестовые значения до и после реверса
        $input = $tests[$i][0];
        $expected = $tests[$i][1];
        //выплняем реверс
        $output = reverseWords($input);
        //сравниваем значение после ревереса и предпологаемого ответа
        if ($output === $expected) {
            echo "Test " . ($i + 1) . " passed\n";
        } else {
            echo "Test " . ($i + 1) . " failed\n";
        }
    }
}

testReverseWords();




