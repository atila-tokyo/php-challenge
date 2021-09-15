<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Search CEP">
    <title>Search CEP </title>
    
</head>

<body class="layout-default">
</body>
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
<form method="post" action="/">
    <div class="field">
        <label class="label">CEP</label>
        <div class="control">
            <input class="input" name="cep" type="text" value="<?php if ($data) {
                                                                    echo $data['input']['cep'];
                                                                } ?>">
        </div>
    </div>
    <input type="hidden" name="command" value="search">
    <div class="control">
        <button class="button is-link">Search</button>
    </div>
</form>

<?php
if ($data && isset($data['result'])) {
?>
    <table>
        <tr>
            <td>cep</td>
            <td>logradouro</td>
            <td>complemento</td>
            <td>bairro</td>
            <td>localidade</td>
            <td>uf</td>
            <td>ibge</td>
            <td>gia</td>
            <td>ddd</td>
            <td>siafi</td>
        </tr>
        <tr>
            <td><?php echo $data['result']['cep']; ?></td>
            <td><?php echo $data['result']['logradouro']; ?></td>
            <td><?php echo $data['result']['complemento']; ?></td>
            <td><?php echo $data['result']['bairro']; ?></td>
            <td><?php echo $data['result']['localidade']; ?></td>
            <td><?php echo $data['result']['uf']; ?></td>
            <td><?php echo $data['result']['ibge']; ?></td>
            <td><?php echo $data['result']['gia']; ?></td>
            <td><?php echo $data['result']['ddd']; ?></td>
            <td><?php echo $data['result']['siafi']; ?></td>
        </tr>
    </table>
<?php
}
?>


<?php view('footer'); ?>

</html>