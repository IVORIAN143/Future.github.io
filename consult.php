consult.php<?php
            session_start();
            if (!isset($_SESSION['auth'])) {
                header('location: login.php');
            }
            include 'template/header.php';
            ?>


<body class="app">
    <header class="app-header fixed-top">

        <?php
        include 'partials/header.php';
        include 'partials/sidebar.php';
        ?>
    </header><!--//app-header-->

    <div class="app-wrapper">

        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <h1 class="app-page-title">Consult</h1>
                <div class="app-card app-card-chart h-100 shadow-sm">
                    <div class="app-card-header p-3 border-0">
                        <h4 class="app-card-title">Doughnut Chart Demo</h4>
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body p-4">
                        <div class="chart-container">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="chart-doughnut" width="453" height="226" style="display: block; width: 453px; height: 226px;" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                    <!--//app-card-body-->
                </div>
                <?php

                ?>

            </div><!--//container-fluid-->
        </div><!--//app-content-->

        <?php
        include 'partials/footer.php';
        ?>

    </div><!--//app-wrapper-->


    <?php
    include 'modal/logout.php';
    include 'template/scripts.php';
    ?>

</body>

</html>