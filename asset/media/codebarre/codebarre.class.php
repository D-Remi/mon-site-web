<?php



class CodeBarre {



    private $code;

    private $color;

    private $height;

    private $size;

    private static $elements = [

        'A' => [

            "___XX_X",

            "__XX__X",

            "__X__XX",

            "_XXXX_X",

            "_X___XX",

            "_XX___X",

            "_X_XXXX",

            "_XXX_XX",

            "_XX_XXX",

            "___X_XX"

        ],

        'B' => [

            "_X__XXX",

            "_XX__XX",

            "__XX_XX",

            "_X____X",

            "__XXX_X",

            "_XXX__X",

            "____X_X",

            "___X__X",

            "___X__X",

            "__X_XXX"

        ],

        'C' => [

            "XXX__X_",

            "XX__XX_",

            "XX_XX__",

            "X____X_",

            "X_XXX__",

            "X__XXX_",

            "X_X____",

            "X___X__",

            "X__X___",

            "XXX_X__"

        ],

        'motifEAN13' => [

            ["A", "A", "A", "A", "A", "A"],

            ["A", "A", "B", "A", "B", "B"],

            ["A", "A", "B", "B", "A", "B"],

            ["A", "A", "B", "B", "B", "A"],

            ["A", "B", "A", "A", "B", "B"],

            ["A", "B", "B", "A", "A", "B"],

            ["A", "B", "B", "B", "A", "A"],

            ["A", "B", "A", "B", "A", "B"],

            ["A", "B", "A", "B", "B", "A"],

            ["A", "B", "B", "A", "B", "A"]

        ],

        'normal' => "X_X",

        'central' => "_X_X_"

    ];



    public function __construct($code, int $size = 200, int $height = 50, string $color = "black") {

        $this->setCode($code);

        $this->size = $size;

        $this->height = $height;

        $this->color = $color;

    }



    public function getCode() {

        return $this->code;

    }



    public function setCode($code) {

        if (is_numeric($code)) {

            $this->code = $code;

        } else {

            die('Vous devez saisir une valeur numérique exclusivement');

        }

    }



    public function getColor() {

        return $this->color;

    }



    public function setColor(string $color) {

        $this->color = $color;

    }



    public function setHeight(int $height) {

        $this->height = $height;

    }



    public function getHeight() {

        return $this->height;

    }



    public function setSize(int $size) {

        $this->size = $size;

    }



    public function getSize() {

        return $this->size;

    }



    private function generateSequence() {

        if (strlen($this->code) === 8) {

            return $this->generateEAN8();

        } elseif (strlen($this->code) === 13) {

            return $this->generateEAN13();

        } else {

            die('Vous devez saisir un EAN 8 ou EAN 13 uniquement.');

        }

    }



    private function generateEAN8() {

        $codeArray = str_split($this->code);

        $sequence = self::$elements['normal'];



        for ($i = 0 ; $i < 4 ; $i++) {

            $sequence .= self::$elements['A'][$codeArray[$i]];

        }



        $sequence .= self::$elements['central'];



        for ($i = 4 ; $i < 8 ; $i++) {

            $sequence .= self::$elements['C'][$codeArray[$i]];

        }



        $sequence .= self::$elements['normal'];

        return $sequence;

    }



    private function generateEAN13() {

        $codeArray = str_split($this->code);

        $motifArray = self::$elements['motifEAN13'][$codeArray[0]];



        $sequence = self::$elements['normal'];



        for ($i = 1 ; $i <= 6 ; $i++) {

            $sequence .= self::$elements[$motifArray[$i - 1]][$codeArray[$i]];

        }



        $sequence .= self::$elements['central'];



        for ($i = 7 ; $i <= 12 ; $i++) {

            $sequence .= self::$elements['C'][$codeArray[$i]];

        }



        $sequence .= self::$elements['normal'];

        return $sequence;

    }



    public function display() {

        $sequenceArray = str_split($this->generateSequence());



        echo "<div style='display: flex; margin: 15px auto; width: " . $this->size . "px;'>";

        foreach($sequenceArray as $elem) {

            if ($elem === "X") {

                echo "<div style='background-color: " . $this->color . "; height: " . $this->height . "px; flex: 1;'></div>";

            } else {

                echo "<div style='background-color: white; height: " . $this->height . "px; flex: 1;'></div>";

            }

        }

        echo "</div>";

    }

}