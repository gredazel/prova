<?php
   session_start();
?>
<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
      <!--</*?php
          $_SESSION["user"]="Greta Piai";
          $_SESSION["tasti"]=[];
      ?*/>
      <a href="fin.php">clicca</a><br/><br/>-->
    <!--  <table>
        <tr>-->
          <?php
            if (isset($_SESSION["turni"]) && $_SESSION["turni"] == 1) {
              $_SESSION["turni"] = 2;
            }
            else{
              $_SESSION["turni"] = 1;
            }
            $_SESSION["mosse"]++;
            //var_dump($_POST); per verificare contenuto dell'array $_POST in modo da aggiornare in modo appropriato l'array con i valori dei tasti
            if (!empty($_POST)) { //è la prima volta nella pagina
              //non devo leggere il bottone premuto
              //se inizio, altrimenti
              //bisogna aggiornare l'array se[$_POST["riga"]][$_POST["bottone"]] = $_SESSION["turni"];ssion['tasti']
              if ($_SESSION['tasti'][$_POST['riga']][$_POST['bottone']] != 0) {
                //l'utente sta facendo il furbo: ha cambiato l'html cercando di mettere il suo segno al posto del segno dell'avversario
                echo "<h1>NON SI BARA(TELLA) BRUTTO BASTARDO!!!!!!!</h1>";
              } else {
                $_SESSION['tasti'][$_POST['riga']][$_POST['bottone']] = $_SESSION["turni"];
				switch (vincita($_SESSION['tasti'])) {
				case 0:
					//gioco continua
					if ($_SESSION["turni"] == 1) {
						//solo tasti
					} else {
						//solo mouse
					}
					break;
				case 1:case 2:
					//vincitore
					echo "<h1>Complimenti ". $_SESSION['player'.$_SESSION['turni']] ."!! Hai vinto in ".$_SESSION['tentativi']."</h1>";
					break;
				case 3:
					//pareggio
					echo "<h1>Avete pareggiato! Volete rigiocare? </h1><h2><a href='./launch.php'> Cliccate qui!</a></h2>";
					break;
					break;
				default: //non dovrebbe esserci alcuna alternativa
				break;
				}
              }
            //  $_SESSION["tasti"][$_POST["riga"]][$_POST["bottone"]] = $_SESSION["turni"];
            }
            //per segato: controlla vincite qui!!!!!!!!!
            $n=1;
              foreach ($_SESSION["tasti"] as $j => $righe) {
                foreach ($_SESSION["tasti"][$j] as $i => $button) {
                  if ($button == 0) {
                    ?>
                    <form style="display:inline;" name="form<?=$n?>" id="form<?=$n?>" action="./gioco.php" method="POST">
                      <input <?=$_SESSION['turni'] == 1 ? "onclick=\"event.preventDefault();console.log(event);\"" : ""?> type="submit" value="premi"/>
                      <input type="hidden" name="riga" value="<?=$j?>"/>
              		  <input type="hidden" name="bottone" value="<?=$i?>"/>
                    </form>
                    <?php
                  }
                  else {
                    // 1 per player1, 2 per player2
                    if ($button == 1) {
                      //stampa simbolo player1
                      ?>
                      <img src="./cerchio.jpg" height="20" width="20"/>
                      <?php
                    }
                    if ($button == 2) {
                      //stampa simbolo player2
                      ?>
                      <img src="./croce.jpg" height="20" width="20"/>
                      <?php
                    }
                  }
                $n++;
                }
                ?>
                <br/>
                <?php

              }
			  
			  if ($_SESSION["turni"] == 1) :
          ?>
			<script>
			var tasto;
			window.onkeyup = function(e) {
				
				var forms = document.getElementsByTagName("form");
				
				var tasto = e.keyCode ? e.keyCode : e.which;
				switch (tasto) {
				case 103:
					document.getElementById('form1').submit();
					break;
				
				case 104:
					document.getElementById('form2').submit();
					break;
				
				case 105:
					document.getElementById('form3').submit();
					break;
				
				case 100:
					document.getElementById('form4').submit();
					break;
				
				case 101:
					document.getElementById('form5').submit();
					break;
				
				case 102:
					document.getElementById('form6').submit();
					break;
				
				case 97:
					document.getElementById('form7').submit();
					break;
				
				case 98:
					document.getElementById('form8').submit();
					break;
				
				case 99:
					document.getElementById('form9').submit();
					break;
				}
			}
			</script>
		  <?php endif; ?>
  </body>
</html>
