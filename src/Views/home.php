<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="layout-default"></body>

<?php view('header'); ?>
<?php
if ($data && isset($data['errors'])) {
?>
    <div class="notification is-danger">
        <?php
        echo "Errors:";
        echo $data['errorMessage'];
        ?>
    </div>
<?php
}
?>
<div class="container row g-3 align-items-center">
    <form method="GET" action="/">
        <div class="col-auto field">
            <label for="cepNumber" class="col-form-label">Digite o CEP que deseja pesquisar</label>
            <div class="col-auto control">
                <input type="text" name="cep" class="input" placeholder="Número do CEP" value="<?php if ($data) {
                                                                                                    echo $data['input']['cep'];
                                                                                            } ?>">
            </div>
        </div>
        <div class="col-auto">
            <span id="cepValid" class="form-text">
                Digite apenas CEPs válidos.
            </span>
        </div>
        <div class="control">
            <button class="button is-link">Search</button>
        </div>
        </form>
