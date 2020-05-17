<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title><?= $title; ?></title>
    <meta charset="utf-8">
</head>
<body onload="window.print()">
<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>REPORT STUFF</h4></center><br/></td>
</tr>
                       
</table>
 
<table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
</table>

<table border="1" align="center" style="width:900px;margin-bottom:20px;">
<?php 
    $urut=0;
    $no=0;
    $group='-';
    foreach($data->result_array()as $d){
    $no++;
    $urut++;
    if($group=='-' || $group!=$d['category']){
        $kat=$d['category'];
        
        if($group!='-')
        echo "</table><br>";
        echo "<table align='center' width='900px;' border='1'>";
        echo "<tr><td colspan='6'><b>Kategori: $kat</b></td> </tr>";
echo "<tr style='background-color:#ccc;'>
    <td width='4%' align='center'>No</td>
    <td width='10%' align='center'>Stuff Code</td>
    <td width='40%' align='center'>Name</td>
    <td width='10%' align='center'>Unit</td>
    <td width='20%' align='center'>Price</td>
    <td width='30%' align='center'>Stock</td>
    
    </tr>";
$no=1;
    }
    $group=$d['category'];
        if($urut==500){
        $no=0;
            echo "<div class='pagebreak'> </div>";

            }
        ?>
        <tr>
                <td style="text-align:center;vertical-align:center;text-align:center;"><?php echo $no; ?></td>
                <td style="vertical-align:center;padding-left:5px;text-align:center;"><?php echo $d['stuff_code']; ?></td>
                <td style="vertical-align:center;padding-left:5px;"><?php echo $d['name']; ?></td>
                <td style="vertical-align:center;text-align:center;"><?php echo $d['satuan']; ?></td>
                <td style="vertical-align:center;padding-right:5px;text-align:right;"><?php echo 'Rp. '.number_format($d['price']); ?></td>
                <td style="vertical-align:center;text-align:center;text-align:center;"><?php echo $d['stock']; ?></td>  
        </tr>
        

        <?php
        }
        ?>
</table>

</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Malang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( <?php echo $this->session->userdata('username');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
</body>
</html>