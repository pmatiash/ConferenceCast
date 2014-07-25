<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <title></title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <style>
        .blue {
            background-color: #0055cc;
        }
    </style>
</head>
<body>
<input id="searchField" type="text" placeholder="search"/>
<label for="#hideRows"></label>
<input type="checkbox" id="hideRows" />

<table>
    <?php for ($tr=0; $tr<10; $tr++): ?>
        <tr>
            <?php for ($td=0; $td<10; $td++): ?>
                <td><?= $tr . "." . $td ?></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>

<script type="text/javascript">
    $('#searchField').keyup(function(){

        $('td').removeClass('blue');
        $('tr').removeClass('active');

        var query = $(this).val();

        if (!query) {
            return;
        }

         $('td:contains(' + query + ')')
             .addClass('blue')
             .closest('tr')
             .addClass('active');

        raiseCheckbox($('#hideRows'));

    });

    $('#hideRows').click(function(){
        raiseCheckbox($(this));
    });

    function raiseCheckbox($checkbox) {
        if ($checkbox.is(':checked')) {
            $('table tr').hide();
            $('table tr.active').show();
        } else {
            $('table tr').show();
        }
    }

</script>

</body>
</html>
