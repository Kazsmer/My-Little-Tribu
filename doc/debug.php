echo __FILE__.’:’.__LINE__; exit();

echo '<div style=\"border: solid 2px #F00\">';
           echo '<div style=\"; background-color:#CCC\">@'.__FILE__.' : '.__LINE__.'</div>';
           echo '<pre style=\"background-color: rgba(255,255,255, 0.8);\">';
            print_r($0);
        echo '</pre>';
   echo '</div>';