<?php
$firstNames=array('Allison','Arthur','Ana','Alex','Arlene','Alberto','Barry','Bertha','Bill','Bonnie',
'Bret','Beryl','Chantal','Cristobal','Claudette','Charley','Cindy','Chris','Dean','Dolly','Danny',
'Danielle','Dennis','Debby','Erin','Edouard','Erika','Earl','Emily','Ernesto','Felix','Fay',
'Fabian','Frances','Franklin','Florence','Gabielle','Gustav','Grace','Gaston','Gert','Gordon',
'Humberto','Hanna','Henri','Hermine','Harvey','Helene','Iris','Isidore','Isabel','Ivan','Irene',
'Isaac','Jerry','Josephine','Juan','Jeanne','Jose','Joyce','Karen','Kyle','Kate','Karl',
'Katrina','Kirk','Lorenzo','Lili','Larry','Lisa','Lee','Leslie','Michelle','Marco','Mindy',
'Maria','Michael','Noel','Nana','Nicholas','Nicole','Nate','Nadine','Olga','Omar','Odette',
'Otto','Ophelia','Oscar','Pablo','Paloma','Peter','Paula','Philippe','Patty','Rebekah','Rene',
'Rose','Richard','Rita','Rafael','Sebastien','Sally','Sam','Shary','Stan','Sandy','Tanya');
$lastNames=array('Abbott','Acevedo','Acosta','Adams','Adkins','Aguilar','Aguirre','Albert',
'Alexander','Alford','Allen','Allison','Alston','Alvarado','Alvarez','Anderson','Andrews','Anthony',
'Armstrong','Arnold','Ashley','Atkins','Atkinson','Austin','Avery','Avila','Ayala','Ayers','Bailey',
'Baird','Baker','Baldwin','Ball','Ballard','Banks','Barber','Barker','Barlow','Barnes','Barnett',
'Barr','Barrera','Barrett','Barron','Barry','Bartlett','Barton','Bass','Bates','Battle','Bauer',
'Baxter','Beach','Bean','Beard','Beasley','Beck','Becker','Bell','Bender','Benjamin','Bennett',
'Benson','Bentley','Benton','Berg','Berger','Bernard','Berry','Best','Bird','Bishop','Black',
'Blackburn','Blackwell','Blair','Blake','Blanchard','Blankenship','Blevins','Bolton','Bond','Bonner',
'Booker','Boone','Booth','Bowen','Bowers','Bowman','Boyd','Boyer','Boyle','Bradford','Bradley');
$cities= array("Sarajevo","Banja Luka","Mostar","Bijeljina","Prijedor","Doboj","Trebinje",
    "Istočno Sarajevo","Zvornik","Bihać","Široki Brijeg","Tuzla","Zenica","Livno","Cazin",
    "Goražde","Gradiška","Živinice","Gračanica","Gradačac","Srebrenik",
    "Visoko","Ljubuški","Čapljina","Derventa");

class Resources{
    function randomStatus(){
        return array_rand(array_flip(array("active","offline","blocked")));
    }
    function randomPermission(){
        return array_rand(array_flip(array("none","view orders","create orders","all")));
    }
    function peopleNames(){
        global $firstNames, $lastNames;
        $names = array_rand(array_flip($firstNames))." ".array_rand(array_flip($lastNames));
        return $names;
    }
    function cities(){
        global $cities;
        $city= array_rand(array_flip($cities));
        return $city;
    }
    function randomString($length){
        $string = '';
        $vowels = array("a","e","i","o","u");
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );

        $max = $length / 2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }
        return $string;
    }
}
?>
