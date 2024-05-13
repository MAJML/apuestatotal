</main>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Proyecto de Practica para Apuesta Total</span>
    </div>
</footer>
<script src="<?=$baseUrl?>js/jquery-3.7.1.min.js"></script>
<script src="<?=$baseUrl?>js/main.js"></script>
<script src="<?=$baseUrl?>js/bootstrap.bundle.min.js"></script>
<script src="<?=$baseUrl?>js/moment.min.js"></script>
<script src="<?=$baseUrl?>js/dataTables.js"></script>
<?php
    if(isset($js)){
        foreach ($js as $row) {
            echo '<script src="'.$baseUrl.''.$row.'" type="text/javascript"></script>';
        }
    }
?>
</body>

</html>