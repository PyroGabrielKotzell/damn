<?php
  $r = rand(0, 255);
  $g = rand(0, 255);
  $b = rand(0, 255);
  $hex = strtoupper('#'.dechex($r).''.dechex($g).''.dechex($b));

  echo '<body style="background-color: rgb('.$r.','.$g.','.$b.')">
          <center>
            <h1 style="
              background-color: white;
              border: solid white;
              border-radius: 5px;
              width: fit-content;
              ">'.$hex.'</h1>
          </center>
        </body>';
?>