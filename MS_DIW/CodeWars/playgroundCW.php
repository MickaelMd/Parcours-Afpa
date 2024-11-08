<!-- --------------------------------------------------

------ https://www.codewars.com/users/MickaelMd -------

--------------------------------------------------- -->

<?php

// function zeroFuel($distanceToPump, $mpg, $fuelLeft) {

//     $distance = $mpg * $fuelLeft;

//     if ($distanceToPump > $distance) {
//         return false;
//     } else {
//         return true;
//     }
// }

// echo zeroFuel(50, 25, 8);

// function reverseSeq ($n) {

//     $array = [];

//     for ($i=$n; $i > 0; $i--) {
//       $newn = $n--;
//         array_push($array, $newn);
//      }
//      return $array;

// };

// print_r(reverseSeq(10));

// $input = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, -11, -12, -13, -14, -15];

// for ($i=count($input); $i > 0; $i--) {
//     echo $i . '</br>';
// }

// function countPositivesSumNegatives($input) {

//     $count = 0;
//     $nbr = -1;
//     $total = 0;
//     $pos = 0;
//     for ($i=count($input); $i > 0; $i--) {
//         $count++;
//         $nbr++;
//         if ($input[$nbr] < 0) {

//             $total = $total + $input[$nbr];

//         }

//         if ($input[$nbr] > 0) {

//             $pos++;

//         }

//     }
//    return $newarray = [$pos, $total];
// }

// print_r( countPositivesSumNegatives([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, -11, -12, -13, -14, -15]) );

// function countPositivesSumNegatives($input) {

//     if (empty($input)) {
//         return [];
//     }

//     $count = 0;
//      $nbr = -1;
//      $total = 0;
//      $pos = 0;
//      for ($i=count($input); $i > 0; $i--) {
//          $count++;
//          $nbr++;
//          if ($input[$nbr] < 0) {
//              $total = $total + $input[$nbr];
//          }
//          if ($input[$nbr] > 0) {

//              $pos++;
//          }
//      }
//     return [$pos, $total];
//  }
//  print_r( countPositivesSumNegatives([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, -11, -12, -13, -14, -15]) );
//  echo '</br>';
//  print_r( countPositivesSumNegatives([]) );

// function string_to_array($s){
//     return explode(' ', $s);
//   }

//   print_r( string_to_array("I love arrays they are my favorite"));

// function fake_bin(string $s): string {
//     $nbrstr = strlen($s);
//     $array = str_split($s);

//     for ($i = 0; $i < $nbrstr; $i++) {

//         if ($array[$i] < 5) {
//             $array[$i] = '0';
//         } else {
//             $array[$i] = '1';
//         }
//     }

//     $result = implode('', $array);
//     return $result;
// }

// echo fake_bin("123456789");
// $a = 1; $b = 9;
// $array = [];
// for ($i=$a; $i < $b; $i++) {

//     array_push($array, $i);

// };

// print_r($array);

// function between(int $a, int $b): array {
//     $array = [];

//     for ($i=$a; $i <= $b; $i++) {

//         array_push($array, $i);

//     };

//     return $array;
//   }

//   print_r(between(-99,31));

// function removeEveryOther($array) {

//     for ($i = count($array) -1; $i >= 0 ; $i--){
//         if (($i % 2) == 1) unset ($array[$i]);
//       }

//     return $array;
//   }

//   print_r( removeEveryOther(["Keep", "Remove", "Keep", "Remove", "Keep", "Romove"]));

// function hero(int $bullets, int $dragons){
//     // throw new Exception("Function not implemented");

//     if ($bullets >= $dragons * 2) {

//         return true;
//     }
//     else {

//         return false;
//     }

// }

// echo hero(4, 2);

// function findNeedle($haystack) {

//     $test = array_search('needle' , $haystack) ;
//     return 'found the needle at position ' . $test;

// };

// echo findNeedle(["hay", "junk", "hay", "hay", "moreJunk", "needle", "randomJunk"]);

// function rpc($p1, $p2) {

//     if ($p1 == $p2) {
//         return 'Draw!';
//     }

//     // Player 1: Scissors, Player 2: Rock
//     if ($p1 == 'scissors' && $p2 == 'rock') {
//         return 'Player 2 won!';
//     }

//     if ($p1 == 'rock' && $p2 == 'scissors') {
//         return 'Player 1 won!';
//     }

//     if ($p1 == 'paper' && $p2 == 'rock') {
//         return 'Player 1 won!';
//     }

//     if ($p1 == 'rock' && $p2 == 'paper') {
//         return 'Player 2 won!';
//     }

//     if ($p1 == 'scissors' && $p2 == 'paper') {
//         return 'Player 1 won!';
//     }

//     if ($p1 == 'paper' && $p2 == 'scissors') {
//         return 'Player 2 won!';
//     }
// }

// echo rpc('scissors', 'rock');

// function remove_char(string $s): string {

// return substr($s, 1, -1,);

// }

// echo remove_char('test');

// function makeNegative($num) {
//     if ($num <= 0) {
//         return $num;
//     }
//     else {
//         return - $num;
//     }
// }

// echo makeNegative(-150);

// function maps($x)
// {
//  $newar = [];

//  foreach ($x as $xs) {

//     $test = $xs * 2;

//     array_push($newar, $test);

//  };
// return $newar;

// }

// print_r(maps([10, 50, 80]));

// function switch_it_up($number)
// {

//     switch ($number) {
//         case 0:
//             $word = 'Zero';
//             break;
//             case 1:
//                 $word = 'One';
//                 break;
//                 case 2:
//                     $word = 'Two';
//                     break;
//                     case 3:
//                         $word = 'Three';
//                         break;
//                         case 4:
//                             $word = 'Four';
//                             break;
//                             case 5:
//                                 $word = 'Five';
//                                 break;
//                                 case 6:
//                                     $word = 'Six';
//                                     break;
//                                     case 7:
//                                         $word = 'Seven';
//                                         break;
//                                         case 8:
//                                             $word = 'Eight';
//                                             break;
//                                             case 9:
//                                                 $word = 'Nine';
//                                                 break;

//     }

//   return $word;
// }

// echo switch_it_up(8);

// function countsheep($num){

//     $text = '';

//         for ($i=1; $i < $num + 1; $i++) {

//             $text .= $i . ' sheep...';

//         }
//     return $text;
//     }

//     echo countsheep(3);

// function lovefunc($flower1, $flower2) {

//     $fl1 = 0;
//     $fl2 = 0;

//     if ($flower1%2 == 1) {

//         $fl1 = 1;

//     }
//     else {
//         $fl1 = 0;
//     };

//     if ($flower2%2 ==1) {
//         $fl2 = 1;
//     }
//     else {
//         $fl2 = 0;
//     }

//     if ($fl1 == $fl2) {

//         $result = false;
//     }
//     else {
//     $result = true;}

//     return $result;
// }

// echo lovefunc(2, 1);

// function summation($n) {

//     //  $nb = $n + 1;
//     $nn = 1;

//     for ($i=0; $i <= $n; $i++) {

//         $nn = $nn + $i;

//     }

//     return $nn -1;
// }

// echo summation(10);

// function spinWords(string $str): string {

//     $strr = explode(' ', $str);
//     $newar = [];

//     foreach ($strr as $strrr) {

//         if (strlen($strrr) >= 5) {

//             array_push($newar, strrev($strrr));

//         }
//         else {
//             array_push($newar, $strrr);
//         }

//     };

//     $str = implode(' ', $newar);

//     return $str;
// }

// echo spinWords('Hey fellow warriors');

// function replaceAll($string) {

//     return explode('#', $string)[0];
// }

// echo replaceAll('www.codewars.com#about');

// function countBy($x, $n) {
//     $z = [];

//     for ($i=1; $i < $n ; $i++) {

//     array_push($z, $i * $x);

//     }

//     return $z;
// }

// print_r(countBy(1, 10));

// function booleanToString($b) {
//     if ($b == true) {
//         $b = 'true';
//     }
//     else {
//         $b = 'false';
//     }
//     return $b;
//   }

//  echo booleanToString(false);

//  ---------- > function booleanToString($b) {
//                 return $b ? "true" : "false";
//                 }

// function gooseFilter($birds) {
//     $geese = ["African", "Roman Tufted", "Toulouse", "Pilgrim", "Steinbacher"];

//     // return an array containing all of the strings in the input array except those that match strings in geese

//     foreach($birds as $key => $value){
//         if(in_array($value,$geese)){
//             unset($birds[$key]);
//         }
//     }

//     return array_values($birds); }

// print_r( gooseFilter( ["Mallard", "Hook Bill", "African", "Crested", "Pilgrim", "Toulouse", "Blue Swedish"]));

// function move($pos, $roll) {

//     return $pos + $roll * 2;
// }

// echo move(3, 6);

// function createPhoneNumber($numbersArray) {

//     $numbersInString = implode('', $numbersArray);
//     $formattedPhoneNumber = preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $numbersInString);
//     return $formattedPhoneNumber;
// }

// echo createPhoneNumber([1, 2, 3, 4, 5, 6, 7, 8, 9, 0]);

// function numberToString($num)
// {
//   return strval($num);
// }

// echo numberToString(123);

// function hoopCount($n)
// {
//     if ($n >= 10) {
//         return 'Great, now move on to tricks';
//     } else {
//         return 'Keep at it until you get it';
//     }
// }

// echo hoopCount(90);

// function hoopCount(int $n): string {
//     return $n >= 10 ? 'Great, now move on to tricks' : 'Keep at it until you get it';        <<<---------------
//   }

// ctype_upper($testcase

//     function is_uppercase($str) {

//         $newstr = preg_replace('/[^a-zA-Z]/', '', $str);
//         return ctype_upper($newstr);
//     }

//   echo is_uppercase("TESTdza  dza");

// $n = 99 * 99;

// --------------------------------------------------------------------------------------------
// echo $n >= 1 ? 'true' : 'false';                     ---------------------------------------
// --------------------------------------------------------------------------------------------

// function reverseWords($str) {

//     return implode(' ', array_map('strrev', explode(' ', $str)));

// }

// echo reverseWords('This is an example!');

// function duplicate_encode($word) {
//     $word = strtolower($word);
//     $sword = '';
//     $letter_count = array();

//     $nw = strlen($word);
//     for ($i = 0; $i < $nw; $i++) {
//         if (isset($letter_count[$word[$i]])) {
//             $letter_count[$word[$i]]++;
//         } else {
//             $letter_count[$word[$i]] = 1;
//         }
//     }

//     for ($i = 0; $i < $nw; $i++) {
//         if ($letter_count[$word[$i]] > 1) {
//             $sword .= ')';
//         } else {
//             $sword .= '(';
//         }
//     }

//     return $sword;
// }

// echo duplicate_encode('tests');

// function likes($names)
// {
//     $count = count($names) - 2;
//     if (count($names) == 1) {
//         return $names[0].' likes this';
//     }
//     if (count($names) == 2) {
//         return $names[0].' and '.$names[1].' like this';
//     }
//     if (count($names) == 3) {
//         return $names[0].', '.$names[1].' and '.$names[2].' like this';
//     }
//     if (count($names) > 2) {
//         return $names[0].', '.$names[1].' and '.$count.' others like this';
//     } else {
//         return 'no one likes this';
//     }
// }

// echo likes(['test test', 'test', 'test']);

// function smash(array $words): string
// {
//     return implode(' ', $words);
// }

// echo smash(['mot', 'mot2', 'mot3']);

// function detect_pangram($string)
// {
//     $pattern = '/^(?=.*a)(?=.*b)(?=.*c)(?=.*d)(?=.*e)(?=.*f)(?=.*g)(?=.*h)(?=.*i)(?=.*j)(?=.*k)(?=.*l)(?=.*m)(?=.*n)(?=.*o)(?=.*p)(?=.*q)(?=.*r)(?=.*s)(?=.*t)(?=.*u)(?=.*v)(?=.*w)(?=.*x)(?=.*y)(?=.*z).*$/i';

//     return preg_match($pattern, $string) ? 'true' : 'false';
// }

// echo detect_pangram('The quick brown fox jumps over the lazy dog');

// function getCount($str)
// {
//     $vowels = ['a', 'e', 'i', 'o', 'u'];
//     $Vowelscount = 0;

//     foreach ($vowels as $substring) {
//         $Vowelscount += substr_count($str, $substring);
//     }

//     return $Vowelscount;
// }

// print_r(getCount('abracadabra'));

function high($x)
{
    $alpha = range('a', 'z');
    $number = range(1, 26);
    $n = 0;

    for ($i = 0; $i < strlen($x); ++$i) {
    }

    return $n;
}

print_r(high('testz'));
