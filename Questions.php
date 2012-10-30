<html>
	<head>
		<title>Questions</title>
		<a href="http://cogniance.com/" target="_blank">
			<img src="logo.png" align="right" alt="Open cogniance.com">
		</a>
		<link rel="shortcut icon" href="/2ndschoolSite/images/favicon.ico" />
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<style>
			SELECT {
			 width: 400px;
			}
			
			TEXTAREA {
			 width: 400px;
			 height: 100px;
			 resize: none;
			}
			
			#username {
			 width: 400px;
			}
			
			#email {
			 width: 400px;
			}
						
			#left {
			 width:200px;
			 float:left;
			}
			
			#content{
			 width:100%;
			}
			
			#right {
			 width:200px;
			 float:right;
			}						
		</style>	
	</head>

	<body>
		<div id = "tabs">
			<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="topics.html">Topics</a></li>
			<li><a href="people.html">People</a></li>
			<li><a href="contactus.html">Contact us</a></li>
			<li><a href="Questions.php">Questions</a></li>
		</div>
			
		<div id="content">
			<div id="center" align="center">
				<H1>Questions</H1>
			</div>
				
			<form id="messages" align="center">
				Select your subject:
				<p>
					<select id="subject">
						<option>Git</option>
						<option>Jmeter</option>
						<option>Xpath</option>
						<option>Your subject</option>
					</select>
				</p>
				Enter your name:
				<br>
				<input type="text" id="username">
				<br>
				Enter your email:
				<br>
				<input type="text" id="email">
				<br>
				Enter your question<br>
				<textarea id="textarea" rows=7 cols=40 name="question" value="Enter your question" onfocus="if (this.value == 'Enter your question') {this.value = '';}" onblur="if (this.value == '') {this.value ='Enter your question';}">Enter your question</textarea>
				<br>
				<br>
				<button style="width:100px;" class="btn" type="button" onclick="CreateDivElement();" onclick="return validateForm();" method="post">Ask</button>
			</form>				
		</div>
		
			
		<script type="text/javascript" language="javascript">  
			function CreateDivElement() { 
			var name=document.getElementById("username").value;
			var email=document.getElementById("email").value;
			var question=document.getElementById("textarea").value;
			if (name==null || name=="")
			  {
			  alert("Fill in your name!");
			  return false;
			  }
			  else {
					if (email==null || email=="") 
						{
							alert("Fill in your email!");
							return false;
							}
					else {
						if (question=="Enter your question" || question=="") {
							alert("Enter your question!");
							return false;
						}
						else {						
							var divElement1 = document.createElement("div"); 
							divElement1.className = "row"; 		
							var divElement = document.createElement("div");   
							divElement.className = "well span8";   
							var h5Element = document.createElement("h5");
							h5Element.innerHTML = document.getElementById("username").value;
							var subjectElement = document.createElement("h5");
							subjectElement.innerHTML = document.getElementById("subject").value;
							var pElement = document.createElement("p");
							pElement.innerHTML = document.getElementById("textarea").value; 
							document.getElementById("messages").appendChild(divElement1);
							divElement1.appendChild(divElement);
							divElement.appendChild(h5Element);  
							divElement.appendChild(subjectElement); 
							divElement.appendChild(pElement);
						}
					}
					
			  }
			}   
		</script> 
<?php 


class CSV { 

    private $_csv_file = null; 


    public function __construct($csv_file) { 
        if (file_exists($csv_file)) { //Если файл существует 
            $this->_csv_file = $csv_file; //Записываем путь к файлу в переменную 10:16 30.10.2012
        } 
        else { //Если файл не найден то вызываем исключение 
            throw new Exception("File \"$csv_file\" not found");  
        } 
    } 

    public function setCSV(Array $csv) { 
        //Открываем csv для до-записи,  
        //если указать w, то  ифнормация которая была в csv будет затерта 
        $handle = fopen($this->_csv_file, "a");  

        foreach ($csv as $value) { //Проходим массив 
            //Записываем, 3-ий параметр - разделитель поля 
            fputcsv($handle, explode(";", $value), ";");  
        } 
        fclose($handle); //Закрываем 
    } 

    /** 
     * Метод для чтения из csv-файла. Возвращает массив с данными из csv 
     * @return array; 
     */ 
    public function getCSV() { 
        $handle = fopen($this->_csv_file, "r"); //Открываем csv для чтения 

        $array_line_full = array(); //Массив будет хранить данные из csv 
        //Проходим весь csv-файл, и читаем построчно. 3-ий параметр разделитель поля 
        while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {  
            $array_line_full[] = $line; //Записываем строчки в массив 
        } 
        fclose($handle); //Закрываем файл 
        return $array_line_full; //Возвращаем прочтенные данные 
    } 

} 

try { 
    $csv = new CSV("question.csv"); //Открываем наш csv 
    /** 
     * Чтение из CSV  (и вывод на экран в красивом виде) 
     */ 
    echo "<h2>Answers:</h2>"; 
    $get_csv = $csv->getCSV(); 
    foreach ($get_csv as $value) { //Проходим по строкам 
        echo "Subject: " . $value[0] . "<br/>"; 
        echo "Nickname: " . $value[1] . "<br/>"; 
        echo "Q: " . $value[2] . "<br/>";
     
echo "A: " . $value[3] . "<br/>";  
        echo "--------<br/>"; 
    } 

  
} 
catch (Exception $e) { //Если csv файл не существует, выводим сообщение 
    echo "Ошибка: " . $e->getMessage(); 
} 
?>	
</body></html>
