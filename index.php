<?php

class RandomIntegers 
{
    public $intArray;

    public function __construct()
    {
        $this->intArray = $this->randomize();
    }
    
    public function randomize()
    {
        $range = range(0, 100);
        shuffle($range);
        
        return array_slice($range, 0, 10);
    }

    public function sum() 
    {
        $additives = array_rand(array_flip($this->intArray), 2);

        return [
            'sum' => array_sum($additives),
            'additives' => $additives
        ];
    }

    public function orderBy($order = '')
    {
        $integers = $this->intArray;

        if(strtoupper($order) == 'ASC') {
            sort($integers);
        } else {
            rsort($integers);
        }

        return $integers;
    }

    public function ave()
    {
        $a = array_filter($this->intArray);
        $average = array_sum($a)/count($a);

        return $average;
    }

    public function displayResult()
    {
        return [
            'integers' => $this->intArray,
            'sum' => $this->sum(),
            'sort' => [
                'asc' => $this->orderBy('asc'),
                'desc' => $this->orderBy('desc')
            ],
            'ave' => $this->ave(),
        ];
    }
}

class SubMain extends RandomIntegers
{
    public function sum()
    {
        $integers = $this->randomize();

        return [
            'integers' => $integers,
            'additives' => [
                $integers[0], $integers[count($this->intArray) - 1]
            ],
            'sum' => $integers[0] + $integers[count($this->intArray) - 1]
        ];
    }
}

$main = new RandomIntegers();
$subMain = new SubMain();

$displayResult = $main->displayResult();
$subMainSumDisplayResult = $subMain->sum();

?>

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div id="app">
            <div class="container d-flex h-100">
                <div class="row justify-content-center align-self-center mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2>Integer array of 10 random</h1>
                            <h3><?php echo join(', ', $displayResult['integers']); ?></h3>

                            <hr />

                            <h2>Sum Method</h1>
                            <h4>Two picked numbers from given random integers: <?php echo $displayResult['sum']['additives'][0] . ' + ' . $displayResult['sum']['additives'][1]; ?>
                            <h4>Sum: <?php echo $displayResult['sum']['sum']; ?></h4>

                            <hr />

                            <h2>Sort Method</h2>
                            <h4>Asc: <?php echo join(', ', $displayResult['sort']['asc']); ?></h4>
                            <h4>Desc: <?php echo join(', ', $displayResult['sort']['desc']); ?></h4>

                            <hr />

                            <h2>Average Method</h2>
                            <h4>Ave: <?php echo $displayResult['ave']; ?></h4>

                            <hr />

                            <h2>Overridden Sum Method From Inheritance</h2>
                            <h4>Integers: <?php echo join(', ', $subMainSumDisplayResult['integers']); ?></h4>
                            <h4>First And Last Elements From The Array: <?php echo join(', ', $subMainSumDisplayResult['additives']); ?></h4>
                            <h4>Sum: <?php echo $subMainSumDisplayResult['sum']; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
