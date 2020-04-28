<?php
session_start();
?>
<?php if (true) : ?>
    <!DOCTYPE html>

    <head>
        <title>Storage</title>
        <link rel="icon" href="assets/icon.png">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="assets/styleCont.css">


    </head>
    
    <body>
        <div class="row">
            <div align="center" class="column">
                <h3>Преузимање</h3>
                <table>
                    <tr>
                        <th style="padding-bottom:20px">Име</th>
                        <th style="padding-bottom:20px">Време Измене</th>
                        <th style="padding-bottom:20px">Величина</th>
                        <th style="padding-bottom:20px;padding-left:15px">Избриши</th>
                    </tr>

                    <?php
                    $files = scandir('../storage');
                    $broj = 0;
                    foreach ($files as $file) {
                        if ($broj >= 2) {
                            $vel = filesize("../storage/$file");
                            $vel = round($vel / pow(1024, 2), 2) . " MB";
                            $vre = filemtime("../storage/$file");
                            $vre = date("j M Y - G:i", $vre);
                            $delFile = "action_delete.php?file=" . "$file";
                            echo "<tr>";
                            echo "<th><a href='action_download.php?file=$file' download>$file</a></th>";
                            echo "<th>$vre</th>";
                            echo "<th>$vel</th>";
                            echo "<th> <a href='$delFile' style='padding-left:33px;text-align:center;' onclick=\"return confirm('Да ли сигурно желите да избришете фајл?')\"> <img src='assets/delete.png' alt='delete' style='text-align:center;width:20x;height:20px;border:0;'> </a> </th>";
                            echo "</tr>";
                        }
                        $broj++;
                    }
                    ?>
                </table>

            </div>
            <div align="center" class="columnv2">
                <h3>Слање</h3>
                <?php
                $diskfs = round((disk_free_space("D:")) / pow(1024, 2), 2) . " MB";
                echo "df: " . $diskfs;
                ?>
                <br>
                <br>
                <form id="upload_form" enctype="multipart/form-data" method="post">
                    <input type="file" name="file1" id="file1">
                    <br>
                    <br>
                    <input type="button" id="uploadButton" value="Upload File" onclick="uploadFile()">
                    <input type="button" value="Abort Upload" onclick="abort()" id="abortButton" style="display: none;">
                    <br>
                    <br>
                    <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
                    <br>
                    <h3 id="status"></h3>
                    <p id="loaded_n_total"></p>
                </form>
                <br>
                <br>
                
                    <h4>php.ini Limit:</h4>
                    <p>
                    <?php echo "Upload Max Filesize: " . ini_get("upload_max_filesize") . "B"; ?> <br>
                    <?php echo "Post Max Size: " . ini_get("post_max_size") . "B"; ?>
                </p>
            </div>
        </div>
        <script>
            function _(el) {
                return document.getElementById(el);
            }

            function abort(){
                location.reload();
            }

            function uploadFile() {
                _("uploadButton").style.display = "none";

                _("abortButton").style.display = "inline";
                var file = _("file1").files[0];
                var formdata = new FormData();
                formdata.append("file1", file);
                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST", "action_upload.php");
                ajax.send(formdata);
            }

            function progressHandler(event) {
                loadedMb = event.loaded / (1024*1024);
                loadedMb = Math.round((loadedMb + Number.EPSILON) * 100) / 100;
                totalMb = event.total / (1024*1024);
                totalMb = Math.round((totalMb + Number.EPSILON) * 100) / 100;
                _("loaded_n_total").innerHTML = "Uploaded " + loadedMb + " MB of " + totalMb + " MB";
                var percent = (event.loaded / event.total) * 100;
                _("progressBar").value = Math.round(percent);
                _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
            }

            function completeHandler(event) {
                _("status").innerHTML = event.target.responseText;
                _("progressBar").value = 0;
                location.reload();
            }

            function errorHandler(event) {
                _("status").innerHTML = "Upload Failed";
            }

            function abortHandler(event) {
                _("status").innerHTML = "Upload Aborted";
            }
        </script>

    </body>

    </html>
<?php else : header("Location: index.php"); ?>


<?php endif; ?>