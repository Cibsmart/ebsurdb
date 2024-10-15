<?php
	session_start();
	if(isset($_SESSION['uid'])){
		$cid = $_SESSION['uid'];
		$rdb = true;
	}
	else{
		if(isset($_POST['r'])){$rdb = false;}
		else{
			$msg = "Forbidden - Not a Valid User";
			header("location:../../login.php?a=".$msg);
		}
	}
	include('../../dbconn.php');
	include('../../utilities/logging.php');
		if(isset($_POST['modify']) || isset($_POST['delete'])){
			$reg = trim(strtoupper($_POST['reg']));
			$ses = $_POST['ses'];
			if($rdb){
				$act = "Managed $reg - $ses Results";
				logg($cid,$act);
				$s = "SELECT user_id FROM db_users WHERE staff_id = '$cid'";
				$r = mysql_query($s);
				$rs = mysql_fetch_array($r) or die(mysql_error());
				$log_id = $rs['user_id'];
			}else{ $log_id = "?" ;}
		}
		
		$tymes = time() + (60 * 60);
		$dates = date("Y-m-d",$tymes);
		$updatetime = date("Y-m-d H:i:s",$tymes);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <link rel="stylesheet" href="../../css/cid.css" type="text/css" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Manage Result ::</title>
<style>
	.trows{
		font-size:13px;
		font-family:Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
	}
	
	.textboxes{
		border:none;
		outline-style:none;
		width:400px;
		background:none;
		font-weight:bolder;
	}
	
	.black{
		background-color:#EBF3F4;
	}
</style>
</head>

<body>
	<?php
		if(isset($_POST['modify']) || isset($_POST['delete'])){
			$sn =  $_POST['sn'];
			$nam =  $_POST['nam'];
			$reg =  $_POST['reg'];
			$inc =  $_POST['inc'];
			$exm =  $_POST['exm'];
			$lod =  $_POST['lod'];
			$sem =  $_POST['sem'];
			$ses =  $_POST['ses'];
			$cod =  $_POST['cod'];
			$til =  $_POST['til'];
			$dep =  $_POST['dep'];
			$exa =  $_POST['exa'];
			$edp =  $_POST['edp'];
			$dat =  $_POST['dat'];
		}
	?>
    
    
    <?php if(isset($_POST['modify'])): //Edit?>
    <form action="processmanage.php" method="post" target="_self">
    	<table class="trows" border="1" cellspacing="0" cellpadding="4" align="center">
        	
            <tr  class="black" style="font-weight:bolder">
            	<td width="100"></td>
                <td  width="300">OLD VALUE(S)</td>
                <td>ENTER NEW VALUE(S)</td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">SN</td>
                <td> <?php echo $sn ?></td>
                <td> <input type="text" id="sn" name="sn" value="<?php echo $sn ?>" class="textboxes" max="400" required="required" /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">NAME</td>
                <td> <?php echo $nam ?></td>
                <td> <input type="text" id="nam" name="nam" value="<?php echo $nam ?>" class="textboxes" required="required" /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">REG. NO.</td>
                <td> <?php echo $reg?></td>
                <td> <input type="text" id="reg" name="reg" value="<?php echo $reg ?>" class="textboxes"  required="required" /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">INC</td>
                <td> <?php echo $inc ?></td>
                <td> <input type="number" id="inc" name="inc" value="<?php echo $inc ?>" class="textboxes" max="100" /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">EXAM</td>
                <td> <?php echo $exm ?></td>
                <td> <input type="number" id="exm" name="exm" value="<?php echo $exm ?>" class="textboxes" max="100"  required="required"/> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">CREDIT UNIT</td>
                <td> <?php echo $lod ?></td>
                <td> <input type="number" id="lod" name="lod" value="<?php echo $lod ?>" class="textboxes" max="18"  required="required"/> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">SEMESTER</td>
                <td> <?php echo $sem ?></td>
                <td> 
                	<select id="sem" name="sem" class="textboxes" style="width:200">
                    	<option value="FIRST" <?php if($sem == "FIRST") echo "selected='selected'" ?> >FIRST</option>
                        <option value="SECOND" <?php if($sem == "SECOND") echo "selected='selected'" ?> >SECOND</option>
                    </select>
                </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">SESSION</td>
                <td> <?php echo $ses ?></td>
                <td> 
                	<select id="ses" name="ses" class="textboxes" style="width:200">
                    	<option value="" selected="selected"></option>
                        <?php 
							$year = date("Y") + 1;
							for($i = $year; $i >= 1999; $i--){
								$y = $i - 1; $set = $y . "/" . $i;
								if($ses == $set) echo "<option value='$set' selected='selected'> $set </option>";
								else echo "<option value='$set'> $set </option>";
							}
						?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">COURSE CODE</td>
                <td> <?php echo $cod ?></td>
                <td> <input type="text" id="cod" name="cod" value="<?php echo $cod ?>" class="textboxes" /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">COURSE TITLE</td>
                <td> <?php echo $til ?></td>
                <td> <input type="text" id="til" name="til" value="<?php echo $til ?>" class="textboxes" /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">DEPARTMENT</td>
                <td> <?php echo $dep ?></td>
                <td>  
                	<select id="dep" name="dep" class="textboxes" style="width:300" required="required">
                    	<option value="" selected="selected"></option>
                        <?php 
							$query = "SELECT dept_name FROM dept_list ORDER BY dept_name ASC";
							$result = mysql_query($query);
							
							while($data = mysql_fetch_array($result)){
								$dept = $data['dept_name'];
								if($dept == $dep) echo "<option value='$dept' selected='selected'>$dept</option>";
								else echo "<option value='$dept'>$dept</option>";
							}
						?>
                    </select>
                </td>
            </tr>
            <tr class="black">
	            <td style="font-weight:bolder">MAIL TITLE</td>
            	<td colspan="2">
                	<textarea rows="2" name="title" class="textboxes" style="width:500px"  required="required" ></textarea>
                </td>
            </tr>
            <tr>
	            <td style="font-weight:bolder">DATE ORIGINATED</td>
            	<td colspan="2">
                	<input type="date" id="date" name="date" value="" style="outline-style:none; border:none" max="<?php echo $dates ?>"  required="required" />
                </td>
            </tr>
            <tr class="black">
	            <td style="font-weight:bolder">STAFF REMARK</td>
            	<td colspan="2">
                	<textarea rows="2" name="remark" class="textboxes" style="width:500px" ></textarea>
                </td>
            </tr>
            <tr>
            	<td colspan="3" align="center">
                        <input type='hidden' id='sn' name='sn1' value='<?php echo $sn ?>' />
                        <input type='hidden' id='nam' name='nam1' value='<?php echo $nam ?>' />
                        <input type='hidden' id='reg' name='reg1' value='<?php echo $reg ?>' />
                        <input type='hidden' id='inc' name='inc1' value='<?php echo $inc ?>' />
                        <input type='hidden' id='exm' name='exm1' value='<?php echo $exm ?>' />
                        <input type='hidden' id='lod' name='lod1' value='<?php echo $lod ?>' />
                        <input type='hidden' id='sem' name='sem1' value='<?php echo $sem ?>' />
                        <input type='hidden' id='ses' name='ses1' value='<?php echo $ses ?>' />
                        <input type='hidden' id='cod' name='cod1' value='<?php echo $cod ?>' />
                        <input type='hidden' id='til' name='til1' value='<?php echo $til ?>' />
                        <input type='hidden' id='dep' name='dep1' value='<?php echo $dep ?>' />
                        <input type='hidden' id='exa' name='exa' value='<?php echo $exa ?>' />
                        <input type='hidden' id='edp' name='edp' value='<?php echo $edp ?>' />
                        <input type='hidden' id='dat' name='dat' value='<?php echo $dat ?>' />
                            
                	<input type="submit" id="button" name="modify" value="Modify"  />
                </td>
            </tr>
        </table>
    </form>
    <?php endif ?>
    
    
    
    <?php if(isset($_POST['delete'])): //Delete?>
    <form action="processmanage.php" method="post" target="_self">
    	<table class="trows" border="1" cellspacing="0" cellpadding="4" align="center">
        	
            <tr  class="black" style="font-weight:bolder">
            	<td width="100"></td>
                <td  width="300">VALUE(S)</td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">SN</td>
                <td> <?php echo $sn ?></td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">NAME</td>
                <td> <?php echo $nam ?></td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">REG. NO.</td>
                <td> <?php echo $reg?></td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">INC</td>
                <td> <?php echo $inc ?></td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">EXAM</td>
                <td> <?php echo $exm ?></td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">CREDIT UNIT</td>
                <td> <?php echo $lod ?></td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">SEMESTER</td>
                <td> <?php echo $sem ?></td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">SESSION</td>
                <td> <?php echo $ses ?></td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">COURSE CODE</td>
                <td> <?php echo $cod ?></td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">COURSE TITLE</td>
                <td> <?php echo $til ?></td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">DEPARTMENT</td>
                <td> <?php echo $dep ?></td>
            </tr>
            <tr class="black">
	            <td style="font-weight:bolder">MAIL TITLE</td>
            	<td >
                	<textarea rows="2" name="title" class="textboxes" style="width:400px"  required="required"></textarea>
                </td>
            </tr>
            <tr>
	            <td style="font-weight:bolder">DATE ORIGINATED</td>
            	<td >
                	<input type="date" id="date" name="date" value="" style="outline-style:none; border:none" max="<?php echo $dates ?>"  required="required"/>
                </td>
            </tr>
            <tr class="black">
	            <td style="font-weight:bolder">STAFF REMARK</td>
            	<td>
                	<textarea rows="2" name="remark" class="textboxes" style="width:400px"></textarea>
                </td>
            </tr>
            <tr>
            	<td colspan="2" align="center">
                		<input type='hidden' id='sn' name='sn1' value='<?php echo $sn ?>' />
                        <input type='hidden' id='nam' name='nam1' value='<?php echo $nam ?>' />
                        <input type='hidden' id='reg' name='reg1' value='<?php echo $reg ?>' />
                        <input type='hidden' id='inc' name='inc1' value='<?php echo $inc ?>' />
                        <input type='hidden' id='exm' name='exm1' value='<?php echo $exm ?>' />
                        <input type='hidden' id='lod' name='lod1' value='<?php echo $lod ?>' />
                        <input type='hidden' id='sem' name='sem1' value='<?php echo $sem ?>' />
                        <input type='hidden' id='ses' name='ses1' value='<?php echo $ses ?>' />
                        <input type='hidden' id='cod' name='cod1' value='<?php echo $cod ?>' />
                        <input type='hidden' id='til' name='til1' value='<?php echo $til ?>' />
                        <input type='hidden' id='dep' name='dep1' value='<?php echo $dep ?>' />
                        <input type='hidden' id='exa' name='exa' value='<?php echo $exa ?>' />
                        <input type='hidden' id='edp' name='edp' value='<?php echo $edp ?>' />
                        <input type='hidden' id='dat' name='dat' value='<?php echo $dat ?>' />
                        
                	<input type="submit" id="button" name="delete" value="Delete"  />
                </td>
            </tr>
        </table>
    </form>
    <?php endif ?>
    
    
    
    <?php if(isset($_POST['new'])): //Add?>
    <form action="processmanage.php" method="post" target="_self">
    	<table class="trows" border="1" cellspacing="0" cellpadding="4" align="center">
        	
            <tr  class="black" style="font-weight:bolder">
            	<td width="100"></td>
                <td>ENTER VALUE(S)</td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">SN</td>
                <td> <input type="text" id="sn" name="sn" class="textboxes" /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">NAME</td>
                <td> <input type="text" id="nam" name="nam" class="textboxes"  required="required"  /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">REG. NO.</td>
                <td> <input type="text" id="reg" name="reg" class="textboxes" required="required" /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">INC</td>
                <td> <input type="number" id="inc" name="inc" class="textboxes" max="100" /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">EXAM</td>
                <td> <input type="number" id="exm" name="exm" class="textboxes" max="100"  required="required"  /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">CREDIT UNIT</td>
                <td> <input type="number" id="lod" name="lod" class="textboxes"  required="required" max="18"  /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">SEMESTER</td>
                <td> 
                	<select id="sem" name="sem" class="textboxes" style="width:200">
                    	<option value="" selected="selected"></option>
                        <option value="FIRST" >FIRST</option>
                        <option value="SECOND">SECOND</option>
                    </select>
                </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">SESSION</td>
                <td>
                	<select id="ses" name="ses" class="textboxes" style="width:200">
                    	<option value="" selected="selected"></option>
                        <?php 
							$year = date("Y") + 1;
							for($i = $year; $i >= 1999; $i--){
								$y = $i - 1;
								echo "<option value='$y/$i'> $y/$i </option>";
							}
						?>
                    </select>
                </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">COURSE CODE</td>
                <td> <input type="text" id="cod" name="cod" class="textboxes"  required="required" /> </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">COURSE TITLE</td>
                <td> <input type="text" id="til" name="til" class="textboxes"  required="required" /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">DEPARTMENT</td>
                <td> 
                	<select id="dep" name="dep" class="textboxes" style="width:300" required="required">
                    	<option value="" selected="selected"></option>
                        <?php 
							$query = "SELECT dept_name FROM dept_list ORDER BY dept_name ASC";
							$result = mysql_query($query);
							
							while($data = mysql_fetch_array($result)){
								$dept = $data['dept_name'];
								echo "<option value='$dept'>$dept</option>";
							}
						?>
                    </select>
                </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">EXAMINER'S NAME</td>
                <td> <input type="text" id="exa" name="exa" class="textboxes" /> </td>
            </tr>
            <tr>
            	<td style="font-weight:bolder">EXAMINER'S DEPT</td>
                <td> 
                	<select id="edp" name="edp" class="textboxes" style="width:300" >
                    	<option value="" selected="selected"></option>
                        <?php 
							$result = mysql_query($query);
							
							while($data = mysql_fetch_array($result)){
								$dept = $data['dept_name'];
								echo "<option value='$dept'>$dept</option>";
							}
						?>
                    </select>
                </td>
            </tr>
            <tr class="black">
            	<td style="font-weight:bolder">DATE OF EXAM</td>
                
                <td> <input type="date" id="dat" name="dat" style="outline-style:none; border:none; background:none" max="<?php echo $dates ?>"/> </td>
            </tr>
            <tr>
	            <td style="font-weight:bolder">MAIL TITLE</td>
            	<td>
                	<textarea rows="2" name="title" class="textboxes" style="width:400px" required="required"></textarea>
                </td>
            </tr>
            <tr class="black">
	            <td style="font-weight:bolder">DATE ORIGINATED</td>
            	<td>
                	
                	<input type="date" id="date" name="date" value="" style="outline-style:none; border:none;  background:none" max="<?php echo $dates ?>" required="required"/>
                </td>
            </tr>
            <tr>
	            <td style="font-weight:bolder">STAFF REMARK</td>
            	<td>
                	<textarea rows="2" name="remark" class="textboxes" style="width:400px"></textarea>
                </td>
            </tr>
            <tr>
            	<td colspan="2" align="center">

                            
                	<input type="submit" id="button" name="add" value="Add"  />
                </td>
            </tr>
        </table>
    </form>
    <?php endif ?>
    
    <p align="center">
		<form action="../manage.php" method="post" name = "adjTranscrip" >
			<input type="submit" value= "Back" id = "summary"/>
		</form>
   	</p>
</body>
</html>
