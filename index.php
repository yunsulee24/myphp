<!doctype html>
<html lang="en">
<head>
    <!-- 必要なメタタグ　文字コードなどの指定 -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの使用 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>CSV</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">CSV import</a>
    <button class="navbar-toggler" type="button"
            data-toggle="collapse"
            data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>
    </button>

</nav>


<div class="session" style="padding-top: 60px">
    <div class="container">

        <div class="row">


            <form class="form-horizontal" action="index.php" method="post" name="upload_excel" enctype="multipart/form-data">
                <fieldset>

                    <!-- フォームの入力（タイトル） -->
                    <legend>CSVファイルを選択してください</legend>

                    <!-- csvファイルを選択 -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">CSVファイル</label>
                        <div class="col-md-4">
                            <input type="file" name="file" id="file" class="input-large">
                        </div>
                    </div>

                    <!-- 分析開始ボタン -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton">分析開始</label>
                        <div class="col-md-4">
                            <!-- nameがImport、typeがサブミットのボタン -->
                            <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">開始</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>

        <div class="row">

            <div class="col-md-12">

		//表の作成
                <table class="table table-striped">
                    <thead>
                    <tr>
                        //行のタイトルの設定
                        <th scope="col">#</th>
                        <th scope="col">ブランド</th>
                        <th scope="col">フリガナ</th>
                        <th scope="col">コード</th>
                        <th scope="col">海外品</th>
                    </tr>
                    </thead>
                    <tbody>


	<!-- ここからphp -->


                    <?php
		    //ロケール情報を設定する
                    setlocale(LC_ALL, 'ja_JP.UTF-8'); 
                    //サブミットボタン（Import）から
                    if(isset($_POST["Import"])){

                        $filename=$_FILES["file"]["tmp_name"];

                        if($_FILES["file"]["size"] > 0)
                        {
                            $file = fopen($filename, "r");
                            $row = 0;
                            //ループ処理の開始、csvファイルからデータを最後まで読み込み
                            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
                            {

                                if($row > 0){
                                    echo "<tr>";
                                    $num = count($getData);
                                    //echo "<p> $num fields in line $row: <br /></p>\n";
                                    for ($line=0; $line < $num; $line++) {
                                        // converter
                                        //文字コードの変換
                                        $converter = mb_convert_encoding($getData[$line], "UTF-8", "SJIS");
                                        echo "<td>" . $converter . "</td>";
                                    }

                                    echo "</tr>";
                                }

                                $row++;
                            }

                            fclose($file);
                        }
                    }

                    ?>


	<!-- ここまでphp -->


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>