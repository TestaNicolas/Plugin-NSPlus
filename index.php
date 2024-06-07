<?php
// Obtener los datos del formulario POST}
$username = isset($_POST['username']) ? $_POST['username'] : 'Nombre del usuario no disponible';
$userId = isset($_POST['userId']) ? $_POST['userId'] : 'ID del usuario no disponible';
$userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : 'Correo electrónico del usuario no disponible';
$userRole = isset($_POST['userRole']) ? $_POST['userRole'] : 'Rol del usuario no disponible';
$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : 'Nombre completo del usuario no disponible';
$courseName = isset($_POST['courseName']) ? $_POST['courseName'] : 'Nombre del curso no disponible';
$examStartDate = isset($_POST['examStartDate']) ? $_POST['examStartDate'] : 'Fecha de inicio del examen no disponible';
$examEndDate = isset($_POST['examEndDate']) ? $_POST['examEndDate'] : 'Fecha de fin del examen no disponible';
?>

<html>

<head>
	<meta charset="utf-8" />
	<title>NS Plus</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/w3.css" />
	<link rel="stylesheet" type="text/css" href="css/NSPDiagram.css" />
	<link rel="stylesheet" type="text/css" href="css/NSPEditor.css" />
	<link rel="stylesheet" type="text/css" href="css/NSPMenu.css" />
	<link rel="stylesheet" type="text/css" href="css/NSPPDF.css" />
	<link rel="stylesheet" type="text/css" href="css/animations.css" />
	<link rel="stylesheet" type="text/css" href="css/switch-button.css" />
	<link rel="stylesheet" type="text/css" href="css/NSPColors.css" id="css/NSPColors.css" />
	<script type="text/javascript">
		var prueba = {
			examStartDate: <?php echo json_encode($mform->startdate); ?>, 
            examEndDate: <?php echo json_encode($mform->enddate); ?>,
		};
	</script>
    <script type="text/javascript">
        var nsParams = {
            username: <?php echo json_encode($username); ?>,
            userId: <?php echo json_encode($userId); ?>,
            userEmail: <?php echo json_encode($userEmail); ?>,
            userRole: <?php echo json_encode($userRole); ?>,
            fullname: <?php echo json_encode($fullname); ?>,
            courseName: <?php echo json_encode($courseName); ?>,
            isExam: 0,
            examStartDate: <?php echo json_encode($examStartDate); ?>, 		// 2024-05-20T00:00:00.000Z
            examEndDate: <?php echo json_encode($examEndDate); ?>,			// 2024-05-20T00:00:00.000Z
			documentName: ""
        };
    </script>
</head>

<body style="display:none">
	<header id="header" class="w3-bar w3-indigo w3-top">
		<img src="img/ort-logo-blanco.png" class="w3-image w3-bar-item" id="ortLogo" alt="ORTLogo" />
		<img src="img/nsplus-logo-white.png" class="w3-image w3-bar-item" id="nsplusLogo" alt="NSPlusLogo" />
		<input id="inputProjectName" type="text" class="w3-bar-item w3-light-grey w3-input"
			placeholder="Proyecto sin título">
		<div class="w3-bar-item">
			<button type="button" id="importProjectBtn" class="w3-btn w3-text-dark-gray w3-light-grey w3-xlarge"><i
					class="fa fa-folder-open-o"></i></button>
			<button type="button" id="exportProjectBtn" class="w3-btn w3-text-dark-gray w3-light-grey w3-xlarge"><i
					class="fa fa-floppy-o"></i></button>
			<button type="button" id="exportPDFBtn" class="w3-btn w3-text-pink w3-light-grey w3-xlarge"><i
					class="fa fa-file-pdf-o"></i></button>
			<button type="button" id="exitBtn" class="w3-btn w3-text-dark-gray w3-light-grey w3-xlarge"><i
					class="fa fa-sign-out"></i></button>

			<input id="fileInput" type="file" accept=".nsplus" name="name" class="invisible" />
		</div>
		<div class="w3-dropdown-hover w3-bar-item w3-indigo w3-mobile">
			<button class="w3-btn w3-light-grey w3-hover-white w3-text-dark-gray w3-large">
				<i class="fa fa-pencil-square-o"></i> <i class="fa fa-caret-down"></i>
			</button>
			<div id="diagramButtons" class="w3-dropdown-content w3-light-grey w3-card-4 w3-mobile">
				<a type="button" class="w3-btn w3-light-grey w3-hover-indigo" id="newParameter">Parámetro</a>
				<a type="button" class="w3-btn w3-light-grey w3-hover-indigo" id="newInitializedConstant">Constante</a>
				<a type="button" class="w3-btn w3-light-grey w3-hover-indigo" id="newVariable">Variable</a>
				<a type="button" class="w3-btn w3-light-grey w3-hover-indigo" id="newInitializedVariable">Variable
					inicializada</a>
			</div>
		</div>
		<div class="w3-bar-item switcher-block">
			<span class="w3-bar-item">Colorear </span>
			<label class="switcher-button">
				<input type="checkbox" id="checkColors" checked>
				<span class="slider round"></span>
			</label>
		</div>
		<!-- <div class="w3-bar-item switcher-block">
			<span class="w3-bar-item">Objetos </span>
			<label class="switcher-button">
				<input type="checkbox" id="checkObjects" checked>
				<span class="slider round"></span>
			</label>
		</div> -->
	</header>

	<button id="buttonOpenDiagrams" class="w3-btn w3-indigo panelButton">Diagramas<i
			class="fa fa-arrow-down"></i></button>
	<button id="buttonOpenBlocks" class="w3-btn w3-indigo panelButton"><i class="fa fa-arrow-down"></i>Bloques</button>

	<div id="main">
		<div class="w3-sidebar w3-animate-left invisible" id="diagramsContainer">
			<div class="controlButtons w3-center w3-padding">
				<div class="w3-bar">
					<button id="newDiagram" class="w3-btn w3-white w3-large w3-text-teal">
						<i class="fa fa-lg fa-plus-circle"></i>
					</button>
					<button id="viewAllDiagrams" class="hidden w3-btn w3-white w3-large w3-text-dark-gray">
						<i class="fa fa-lg fa-eye"></i></button>
					<button id="buttonCloseDiagrams" class="w3-btn w3-white w3-large w3-text-red">
						<i class="fa fa-lg fa-window-close"></i>
					</button>
				</div>
			</div>
			<div id="diagramsItemsContainer"></div>
		</div>

		<div id="menuContainer" class="w3-sidebar w3-animate-right invisible">
			<div class="controlButtons w3-center w3-padding">
				<div class="w3-bar">
					<button id="buttonCloseBlocks" class="w3-btn w3-white w3-large w3-text-red">
						<i class="fa fa-lg fa-window-close"></i>
					</button>
				</div>
			</div>
		</div>

		<i id="trash" droppable="true" class="invisible fa fa-sm fa-trash w3-text-indigo"></i>
		<section id="sectionDiagram"
			class="w3-animate-zoom w3-container w3-padding-16 initial-margin-left initial-margin-right">
			<div id="actualDiagram">

			</div>
		</section>
	</div>

	<footer id="footer" class="w3-indigo w3-bottom w3-row w3-padding-small">
		<div class="professor w3-col s4 w3-center w3-cell w3-cell-middle">
			<i class="fa fa-sm fa-github"></i>
			<a href="http://www.github.com/axxonita">Prof. C. Daniel Vázquez</a>
		</div>
		<div class="message w3-col s4 w3-center" id="historialBtn">Para toda la Comunidad de ORT</div>
		<div class="professor w3-col s4 w3-center">
			<i class="fa fa-sm fa-github"></i>
			<a href="http://www.github.com/CharlyCimino">Prof. Carlos E. Cimino</a>
		</div>
		<!-- <div id="historialBtn" class="fa fa-book historial"></div> -->
		<div id="hist-popup" class="w3-indigo hidden"></div>
	</footer>

	<div id="projectPrint" class="w3-container invisible">
		<div class="PDFHeader">
			<img src="img/ort-logo-original.png" class="w3-image w3-bar-item" id="ortLogoPDF" alt="ORTLogo" />
			<img src="img/nsplus-logo-indigo.png" class="w3-image w3-bar-item" id="nsplusLogoPDF" alt="NSPlusLogo" />
			<h1 id="PDFTitle" class="w3-large w3-center"></h1>
			<h2 id="PDFSubTitle" class="w3-small w3-center">
				<span id="PDFAutor"></span> |
				<span id="PDFCourse"></span> |
				<span id="PDFDate"></span> |
				<span id="PDFMinutes"></span>
			</h2>
		</div>
		<div id="projectPrintDiagrams"></div>
	</div>
</body>
<script type="application/javascript" src="NSPlus.js"></script>
</html>