<?php
    if(isset($_POST["btncalcular"])){

        sleep(2);
        //Agrego los archivos de las respectivas clases
        require_once 'logica/Salario.php';
        require_once 'logica/Salud.php';
        require_once 'logica/Pension.php';
        require_once 'logica/Caja.php';

         //recuperar valores del formulario
         $cantidadHoras = $_POST["txthorastrabajadas"];
         $valorHora = $_POST["txtcostohoratrabajo"];
 

        //Instanciar clases hijas
        $objSalario = new Salario($cantidadHoras,$valorHora);
        $objSalud = new Salud($cantidadHoras,$valorHora);
        $objPension = new Pension($cantidadHoras,$valorHora);
        $objCaja = new Caja($cantidadHoras,$valorHora);

       
        //llenar atributos por cada instancia.
        //$objSalario->setCantidadHoras($cantidadHoras);
        //$objSalario->setValorHora($valorHora);

        echo "El salario bruto es: " . $objSalario->calcularSalarioBruto(). "<br>"; 

        if($objSalario->calcularSalarioBruto() <= 1000000){
           echo "<br> Descuento de salud:<br> " . $objSalud->calcularSalud(0.02). "<br>";

           echo "<br> Descuento de pension:<br> " . $objPension->calcularPension(0.04). "<br>";

            $incrmento = $objSalario->calcularSalarioBruto() * 0.03;
            echo "<br>Incremento: ". $incrmento."<br>";
            $salarioFinal =($objSalario->calcularSalarioBruto()+ $incrmento) - $objSalud->calcularSalud(0.02)-$objPension->calcularPension(0.04);

            
            echo "<br>Salario a pagar:<br> " . $salarioFinal;

        }else if($objSalario->calcularSalarioBruto() > 1000000 && $objSalario->calcularSalarioBruto() <= 2000000){
            echo "<br> Descuento de salud:<br> " . $objSalud->calcularSalud(0.04). "<br>";


            echo "<br> Descuento de pension:<br> " . $objPension->calcularPension(0.06). "<br>";
            echo "<br> Descuento de la caja compensacion es:<br> " . $objCaja->calcularCaja(0.02). "<br>";

            $salarioFinal =$objSalario->calcularSalarioBruto() - $objSalud->calcularSalud(0.04)-$objPension->calcularPension(0.06) - $objCaja->calcularCaja(0.02);

            echo "<br>Salario a pagar:<br> " . $salarioFinal;
        }else if($objSalario->calcularSalarioBruto() > 2000000){


            echo "<br> Descuento de salud:<br> " . $objSalud->calcularSalud(0.05). "<br>";
            echo "<br> Descuento de pension:<br> " . $objPension->calcularPension(0.07). "<br>";

            echo "<br> Descuento de la caja compensacion es:<br> " . $objCaja->calcularCaja(0.03). "<br>";

            $salarioFinal =$objSalario->calcularSalarioBruto() - $objSalud->calcularSalud(0.05)-$objPension->calcularPension(0.07) - $objCaja->calcularCaja(0.03);

            echo "<br>Salario a pagar:<br> " . $salarioFinal;
        }
        



    }else{
        echo "Estas hackiiando mi sistema, vamos a llamr a la policia";
    }


?>