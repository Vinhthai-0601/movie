<?php     include 'function/search.php'; ?>
<div class="wrapper">
                <?php 
                    if (isset($_REQUEST['ok'])) {
                        search();
                    }

                 ?>            
            </div>