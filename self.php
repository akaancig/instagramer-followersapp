<?php
    require ('instagram_unfollowers.php');
?>

<php>

<html>

<head>
    <link rel="stylesheet" href="css/self.css">
</head>


<body>
    <div id="first">
        <h1 style="font-size: 50px" align="center">Kendi Takipçilerin</h1>
        <p style="padding: 10px; background:white;border:5px outset gray;font-family: a;font-size: 21px" align="center">Burada kendi takip-takipçi bilgilerinden oluşan hayranlar,karşılıklı takip ettiklerin ve
            seni takip etmeyen profiller görüntülenir.</p>
        <h2 style="font-family:b;font-size: 80px" align="center"><?php echo $username; ?></h2>
    </div>
    <div id="second">

        <table class="table" border="0" width="90%" align="center">
            <tr>
                <th>SENİ TAKİP ETMEYEN</th>
                <th>KARŞILIKLI</th>
                <th>HAYRANLAR</th>
            </tr>
            <tr valign="top">
                <td>
                    <table class="unfollowers" border="0" align="center">
                        <?php
                        foreach ($unfollowers as $key => $value){
                            echo "<tr>".
                                "<td>$key</td>" . "<td>=></td>" . "<td>$value</td>".
                                "</tr>";
                        }
                        ?>
                    </table>
                </td>

                <td>
                    <table class="karsilikli" border="0" align="center">
                        <?php
                        foreach ($karsilikli as $key => $value){
                            echo "<tr>".
                                "<td>$key</td>" . "<td>=></td>" . "<td>$value</td>".
                                "</tr>";
                        }
                        ?>
                    </table>
                </td>

                <td>
                    <table class="hayranlar" border="0" align="center">
                        <?php
                        foreach ($hayranlar as $key => $value){
                            echo "<tr>".
                                "<td>$key</td>" . "<td>=></td>" . "<td>$value</td>".
                                "</tr>";
                        }
                        ?>
                    </tablec>
                </td>
            </tr>

        </table>

    </div>

</body>


</html>

</php>