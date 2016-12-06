<h2 id="title-page">Gráfico de Devoluções</h2>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td class="filter">
                    <form name="filter_devolutions" method="POST" action="?folder=consults/&file=jtc_devolutions_grafic_consults&ext=php">
                        <?php
                            if(@$_POST["type"]==0){
                                ?>
                                    <label for="radio_0"><input type="radio" checked="checked" id="radio_0" name="type" value="0">Mês atual</label>
                                    <label for="radio_1"><input type="radio" id="radio_1" name="type" value="1">Personalizado</label>
                                <?php
                            }else{
                                ?>
                                    <label for="radio_0"><input type="radio" id="radio_0" name="type" value="0">Mês atual</label>
                                    <label for="radio_1"><input type="radio" checked="checked" id="radio_1" name="type" value="1">Personalizado</label>
                                <?php
                            }
                        ?>
                        <input id="input_date_start" type="text" class="datepicker" name="date_start" maxlength="10" placeholder="Data de início" value="<?php echo @$_POST["date_start"];?>">
                        <input id="input_date_end" type="text" class="datepicker" name="date_end" maxlength="10" placeholder="Data de fim" value="<?php echo @$_POST["date_end"];?>">
                        <button type="submit">Filtrar</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        if(@$_POST["type"]==0){
                            $sql_select_entries = "SELECT entries.date, entries.type, SUM(entries_has_products_has_sizes.quantity) AS quantity, products.code, products.model FROM entries INNER JOIN entries_has_products_has_sizes ON entries_has_products_has_sizes.entries_id = entries.id INNER JOIN products_has_sizes ON products_has_sizes.id = entries_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id WHERE entries.type = 1 GROUP BY products.id";$sql_select_entries = "SELECT entries.date, entries.type, SUM(entries_has_products_has_sizes.quantity) AS quantity, products.code, products.model FROM entries INNER JOIN entries_has_products_has_sizes ON entries_has_products_has_sizes.entries_id = entries.id INNER JOIN products_has_sizes ON products_has_sizes.id = entries_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id WHERE entries.type = 1 AND (entries.date>='".date("Y-m")."-01' AND entries.date<='".date("Y-m")."-01' + INTERVAL 1 MONTH) GROUP BY products.id";
                        }else{
                            $sql_select_entries = "SELECT entries.date, entries.type, SUM(entries_has_products_has_sizes.quantity) AS quantity, products.code, products.model FROM entries INNER JOIN entries_has_products_has_sizes ON entries_has_products_has_sizes.entries_id = entries.id INNER JOIN products_has_sizes ON products_has_sizes.id = entries_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id WHERE entries.type = 1 GROUP BY products.id";$sql_select_entries = "SELECT entries.date, entries.type, SUM(entries_has_products_has_sizes.quantity) AS quantity, products.code, products.model FROM entries INNER JOIN entries_has_products_has_sizes ON entries_has_products_has_sizes.entries_id = entries.id INNER JOIN products_has_sizes ON products_has_sizes.id = entries_has_products_has_sizes.products_has_sizes_id INNER JOIN products ON products.id = products_has_sizes.products_id WHERE entries.type = 1  AND (entries.date>='".date_converter($_POST["date_start"], "/")."' AND entries.date<='".date_converter($_POST["date_end"], "/")."') GROUP BY products.id";
                        }
                        $sql_select_entries_prepare = $dbconnection->prepare($sql_select_entries);
                        $sql_select_entries_prepare->execute();
                        if($sql_select_entries_prepare->rowCount()>0){

                            ?>
                    <canvas id="myChart"  height="150"></canvas>
                    <script>
                        var ctx = document.getElementById("myChart");
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                datasets: [
                                    <?php
                                        $c = 0;
                                        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                                        while ($sql_select_entries_date = $sql_select_entries_prepare->fetch()) {
                                            echo "{";
                                            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
                                            $c++;
                                    ?>label: [<?php echo '"'.$sql_select_entries_date["code"]." - ".$sql_select_entries_date["model"].'"'?>],
                                    data: [<?php echo $sql_select_entries_date["quantity"]?>],
                                    backgroundColor: ["<?php echo $color;?>"],
                                    borderColor: ["<?php echo $color;?>"],
                                    borderWidth: 1
                                        },
                                            <?php
                                        }
                                    ?>],
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                    <?php
                        }else{
                            echo "Não há registros!";
                        }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
