<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "SERVICIOSinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$SERVICIOS_edit = NULL; // Initialize page object first

class cSERVICIOS_edit extends cSERVICIOS {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{803A0725-AF43-41D4-9FF6-CD1AEBA17FEC}';

	// Table name
	var $TableName = 'SERVICIOS';

	// Page object name
	var $PageObjName = 'SERVICIOS_edit';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (SERVICIOS)
		if (!isset($GLOBALS["SERVICIOS"]) || get_class($GLOBALS["SERVICIOS"]) == "cSERVICIOS") {
			$GLOBALS["SERVICIOS"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["SERVICIOS"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'SERVICIOS', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id_servicio->SetVisibility();
		$this->id_servicio->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->escuela->SetVisibility();
		$this->cargo->SetVisibility();
		$this->persona->SetVisibility();
		$this->fecha_alta->SetVisibility();
		$this->fecha_baja->SetVisibility();
		$this->activo->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $SERVICIOS;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($SERVICIOS);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "SERVICIOSview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
				}
				echo ew_ArrayToJson(array($row));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_id_servicio")) {
				$this->id_servicio->setFormValue($objForm->GetValue("x_id_servicio"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["id_servicio"])) {
				$this->id_servicio->setQueryStringValue($_GET["id_servicio"]);
				$loadByQuery = TRUE;
			} else {
				$this->id_servicio->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->LoadRow();

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("SERVICIOSlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "SERVICIOSlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->id_servicio->FldIsDetailKey)
			$this->id_servicio->setFormValue($objForm->GetValue("x_id_servicio"));
		if (!$this->escuela->FldIsDetailKey) {
			$this->escuela->setFormValue($objForm->GetValue("x_escuela"));
		}
		if (!$this->cargo->FldIsDetailKey) {
			$this->cargo->setFormValue($objForm->GetValue("x_cargo"));
		}
		if (!$this->persona->FldIsDetailKey) {
			$this->persona->setFormValue($objForm->GetValue("x_persona"));
		}
		if (!$this->fecha_alta->FldIsDetailKey) {
			$this->fecha_alta->setFormValue($objForm->GetValue("x_fecha_alta"));
			$this->fecha_alta->CurrentValue = ew_UnFormatDateTime($this->fecha_alta->CurrentValue, 0);
		}
		if (!$this->fecha_baja->FldIsDetailKey) {
			$this->fecha_baja->setFormValue($objForm->GetValue("x_fecha_baja"));
			$this->fecha_baja->CurrentValue = ew_UnFormatDateTime($this->fecha_baja->CurrentValue, 0);
		}
		if (!$this->activo->FldIsDetailKey) {
			$this->activo->setFormValue($objForm->GetValue("x_activo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id_servicio->CurrentValue = $this->id_servicio->FormValue;
		$this->escuela->CurrentValue = $this->escuela->FormValue;
		$this->cargo->CurrentValue = $this->cargo->FormValue;
		$this->persona->CurrentValue = $this->persona->FormValue;
		$this->fecha_alta->CurrentValue = $this->fecha_alta->FormValue;
		$this->fecha_alta->CurrentValue = ew_UnFormatDateTime($this->fecha_alta->CurrentValue, 0);
		$this->fecha_baja->CurrentValue = $this->fecha_baja->FormValue;
		$this->fecha_baja->CurrentValue = ew_UnFormatDateTime($this->fecha_baja->CurrentValue, 0);
		$this->activo->CurrentValue = $this->activo->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id_servicio->setDbValue($row['id_servicio']);
		$this->escuela->setDbValue($row['escuela']);
		$this->cargo->setDbValue($row['cargo']);
		$this->persona->setDbValue($row['persona']);
		$this->fecha_alta->setDbValue($row['fecha_alta']);
		$this->fecha_baja->setDbValue($row['fecha_baja']);
		$this->activo->setDbValue(((ew_ConvertToBool($row['activo'])) ? "1" : "0"));
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id_servicio'] = NULL;
		$row['escuela'] = NULL;
		$row['cargo'] = NULL;
		$row['persona'] = NULL;
		$row['fecha_alta'] = NULL;
		$row['fecha_baja'] = NULL;
		$row['activo'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id_servicio->DbValue = $row['id_servicio'];
		$this->escuela->DbValue = $row['escuela'];
		$this->cargo->DbValue = $row['cargo'];
		$this->persona->DbValue = $row['persona'];
		$this->fecha_alta->DbValue = $row['fecha_alta'];
		$this->fecha_baja->DbValue = $row['fecha_baja'];
		$this->activo->DbValue = ((ew_ConvertToBool($row['activo'])) ? "1" : "0");
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id_servicio")) <> "")
			$this->id_servicio->CurrentValue = $this->getKey("id_servicio"); // id_servicio
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id_servicio
		// escuela
		// cargo
		// persona
		// fecha_alta
		// fecha_baja
		// activo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id_servicio
		$this->id_servicio->ViewValue = $this->id_servicio->CurrentValue;
		$this->id_servicio->ViewCustomAttributes = "";

		// escuela
		if (strval($this->escuela->CurrentValue) <> "") {
			$sFilterWrk = "[CLAVE]" . ew_SearchString("=", $this->escuela->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT [CLAVE], [CLAVE] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [ESCUELA]";
		$sWhereWrk = "";
		$this->escuela->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->escuela, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->escuela->ViewValue = $this->escuela->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->escuela->ViewValue = $this->escuela->CurrentValue;
			}
		} else {
			$this->escuela->ViewValue = NULL;
		}
		$this->escuela->ViewCustomAttributes = "";

		// cargo
		if (strval($this->cargo->CurrentValue) <> "") {
			$sFilterWrk = "[id_cargo]" . ew_SearchString("=", $this->cargo->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT [id_cargo], [cargo] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [cargos]";
		$sWhereWrk = "";
		$this->cargo->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cargo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->cargo->ViewValue = $this->cargo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cargo->ViewValue = $this->cargo->CurrentValue;
			}
		} else {
			$this->cargo->ViewValue = NULL;
		}
		$this->cargo->ViewCustomAttributes = "";

		// persona
		if (strval($this->persona->CurrentValue) <> "") {
			$sFilterWrk = "[id_persona]" . ew_SearchString("=", $this->persona->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT [id_persona], [apellido] AS [DispFld], [nombre] AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [persona]";
		$sWhereWrk = "";
		$this->persona->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->persona, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->persona->ViewValue = $this->persona->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->persona->ViewValue = $this->persona->CurrentValue;
			}
		} else {
			$this->persona->ViewValue = NULL;
		}
		$this->persona->ViewCustomAttributes = "";

		// fecha_alta
		$this->fecha_alta->ViewValue = $this->fecha_alta->CurrentValue;
		$this->fecha_alta->ViewValue = ew_FormatDateTime($this->fecha_alta->ViewValue, 0);
		$this->fecha_alta->ViewCustomAttributes = "";

		// fecha_baja
		$this->fecha_baja->ViewValue = $this->fecha_baja->CurrentValue;
		$this->fecha_baja->ViewValue = ew_FormatDateTime($this->fecha_baja->ViewValue, 0);
		$this->fecha_baja->ViewCustomAttributes = "";

		// activo
		if (ew_ConvertToBool($this->activo->CurrentValue)) {
			$this->activo->ViewValue = $this->activo->FldTagCaption(1) <> "" ? $this->activo->FldTagCaption(1) : "Yes";
		} else {
			$this->activo->ViewValue = $this->activo->FldTagCaption(2) <> "" ? $this->activo->FldTagCaption(2) : "No";
		}
		$this->activo->ViewCustomAttributes = "";

			// id_servicio
			$this->id_servicio->LinkCustomAttributes = "";
			$this->id_servicio->HrefValue = "";
			$this->id_servicio->TooltipValue = "";

			// escuela
			$this->escuela->LinkCustomAttributes = "";
			$this->escuela->HrefValue = "";
			$this->escuela->TooltipValue = "";

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";
			$this->cargo->TooltipValue = "";

			// persona
			$this->persona->LinkCustomAttributes = "";
			$this->persona->HrefValue = "";
			$this->persona->TooltipValue = "";

			// fecha_alta
			$this->fecha_alta->LinkCustomAttributes = "";
			$this->fecha_alta->HrefValue = "";
			$this->fecha_alta->TooltipValue = "";

			// fecha_baja
			$this->fecha_baja->LinkCustomAttributes = "";
			$this->fecha_baja->HrefValue = "";
			$this->fecha_baja->TooltipValue = "";

			// activo
			$this->activo->LinkCustomAttributes = "";
			$this->activo->HrefValue = "";
			$this->activo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_servicio
			$this->id_servicio->EditAttrs["class"] = "form-control";
			$this->id_servicio->EditCustomAttributes = "";
			$this->id_servicio->EditValue = $this->id_servicio->CurrentValue;
			$this->id_servicio->ViewCustomAttributes = "";

			// escuela
			$this->escuela->EditCustomAttributes = "";
			if (trim(strval($this->escuela->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[CLAVE]" . ew_SearchString("=", $this->escuela->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT [CLAVE], [CLAVE] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [ESCUELA]";
			$sWhereWrk = "";
			$this->escuela->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->escuela, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->escuela->ViewValue = $this->escuela->DisplayValue($arwrk);
			} else {
				$this->escuela->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->escuela->EditValue = $arwrk;

			// cargo
			$this->cargo->EditCustomAttributes = "";
			if (trim(strval($this->cargo->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[id_cargo]" . ew_SearchString("=", $this->cargo->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT [id_cargo], [cargo] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [cargos]";
			$sWhereWrk = "";
			$this->cargo->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cargo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->cargo->ViewValue = $this->cargo->DisplayValue($arwrk);
			} else {
				$this->cargo->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cargo->EditValue = $arwrk;

			// persona
			$this->persona->EditCustomAttributes = "";
			if (trim(strval($this->persona->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[id_persona]" . ew_SearchString("=", $this->persona->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT [id_persona], [apellido] AS [DispFld], [nombre] AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [persona]";
			$sWhereWrk = "";
			$this->persona->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->persona, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->persona->ViewValue = $this->persona->DisplayValue($arwrk);
			} else {
				$this->persona->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->persona->EditValue = $arwrk;

			// fecha_alta
			$this->fecha_alta->EditAttrs["class"] = "form-control";
			$this->fecha_alta->EditCustomAttributes = "";
			$this->fecha_alta->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_alta->CurrentValue, 8));
			$this->fecha_alta->PlaceHolder = ew_RemoveHtml($this->fecha_alta->FldCaption());

			// fecha_baja
			$this->fecha_baja->EditAttrs["class"] = "form-control";
			$this->fecha_baja->EditCustomAttributes = "";
			$this->fecha_baja->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_baja->CurrentValue, 8));
			$this->fecha_baja->PlaceHolder = ew_RemoveHtml($this->fecha_baja->FldCaption());

			// activo
			$this->activo->EditCustomAttributes = "";
			$this->activo->EditValue = $this->activo->Options(FALSE);

			// Edit refer script
			// id_servicio

			$this->id_servicio->LinkCustomAttributes = "";
			$this->id_servicio->HrefValue = "";

			// escuela
			$this->escuela->LinkCustomAttributes = "";
			$this->escuela->HrefValue = "";

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";

			// persona
			$this->persona->LinkCustomAttributes = "";
			$this->persona->HrefValue = "";

			// fecha_alta
			$this->fecha_alta->LinkCustomAttributes = "";
			$this->fecha_alta->HrefValue = "";

			// fecha_baja
			$this->fecha_baja->LinkCustomAttributes = "";
			$this->fecha_baja->HrefValue = "";

			// activo
			$this->activo->LinkCustomAttributes = "";
			$this->activo->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($this->id_servicio->FormValue)) {
			ew_AddMessage($gsFormError, $this->id_servicio->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->fecha_alta->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_alta->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->fecha_baja->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_baja->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// id_servicio
			// escuela

			$this->escuela->SetDbValueDef($rsnew, $this->escuela->CurrentValue, NULL, $this->escuela->ReadOnly);

			// cargo
			$this->cargo->SetDbValueDef($rsnew, $this->cargo->CurrentValue, NULL, $this->cargo->ReadOnly);

			// persona
			$this->persona->SetDbValueDef($rsnew, $this->persona->CurrentValue, NULL, $this->persona->ReadOnly);

			// fecha_alta
			$this->fecha_alta->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_alta->CurrentValue, 0), NULL, $this->fecha_alta->ReadOnly);

			// fecha_baja
			$this->fecha_baja->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_baja->CurrentValue, 0), NULL, $this->fecha_baja->ReadOnly);

			// activo
			$this->activo->SetDbValueDef($rsnew, ((strval($this->activo->CurrentValue) == "1") ? "1" : "0"), 0, $this->activo->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("SERVICIOSlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_escuela":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT [CLAVE] AS [LinkFld], [CLAVE] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [ESCUELA]";
			$sWhereWrk = "";
			$this->escuela->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '[CLAVE] IN ({filter_value})', "t0" => "202", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->escuela, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_cargo":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT [id_cargo] AS [LinkFld], [cargo] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [cargos]";
			$sWhereWrk = "";
			$this->cargo->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '[id_cargo] IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cargo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_persona":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT [id_persona] AS [LinkFld], [apellido] AS [DispFld], [nombre] AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [persona]";
			$sWhereWrk = "";
			$this->persona->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '[id_persona] IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->persona, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($SERVICIOS_edit)) $SERVICIOS_edit = new cSERVICIOS_edit();

// Page init
$SERVICIOS_edit->Page_Init();

// Page main
$SERVICIOS_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SERVICIOS_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fSERVICIOSedit = new ew_Form("fSERVICIOSedit", "edit");

// Validate form
fSERVICIOSedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_id_servicio");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($SERVICIOS->id_servicio->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_alta");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($SERVICIOS->fecha_alta->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_baja");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($SERVICIOS->fecha_baja->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fSERVICIOSedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fSERVICIOSedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fSERVICIOSedit.Lists["x_escuela"] = {"LinkField":"x_CLAVE","Ajax":true,"AutoFill":false,"DisplayFields":["x_CLAVE","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"ESCUELA"};
fSERVICIOSedit.Lists["x_escuela"].Data = "<?php echo $SERVICIOS_edit->escuela->LookupFilterQuery(FALSE, "edit") ?>";
fSERVICIOSedit.Lists["x_cargo"] = {"LinkField":"x_id_cargo","Ajax":true,"AutoFill":false,"DisplayFields":["x_cargo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cargos"};
fSERVICIOSedit.Lists["x_cargo"].Data = "<?php echo $SERVICIOS_edit->cargo->LookupFilterQuery(FALSE, "edit") ?>";
fSERVICIOSedit.Lists["x_persona"] = {"LinkField":"x_id_persona","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"persona"};
fSERVICIOSedit.Lists["x_persona"].Data = "<?php echo $SERVICIOS_edit->persona->LookupFilterQuery(FALSE, "edit") ?>";
fSERVICIOSedit.Lists["x_activo"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fSERVICIOSedit.Lists["x_activo"].Options = <?php echo json_encode($SERVICIOS_edit->activo->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $SERVICIOS_edit->ShowPageHeader(); ?>
<?php
$SERVICIOS_edit->ShowMessage();
?>
<form name="fSERVICIOSedit" id="fSERVICIOSedit" class="<?php echo $SERVICIOS_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($SERVICIOS_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $SERVICIOS_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SERVICIOS">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($SERVICIOS_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($SERVICIOS->id_servicio->Visible) { // id_servicio ?>
	<div id="r_id_servicio" class="form-group">
		<label id="elh_SERVICIOS_id_servicio" for="x_id_servicio" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->id_servicio->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->id_servicio->CellAttributes() ?>>
<span id="el_SERVICIOS_id_servicio">
<span<?php echo $SERVICIOS->id_servicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $SERVICIOS->id_servicio->EditValue ?></p></span>
</span>
<input type="hidden" data-table="SERVICIOS" data-field="x_id_servicio" name="x_id_servicio" id="x_id_servicio" value="<?php echo ew_HtmlEncode($SERVICIOS->id_servicio->CurrentValue) ?>">
<?php echo $SERVICIOS->id_servicio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SERVICIOS->escuela->Visible) { // escuela ?>
	<div id="r_escuela" class="form-group">
		<label id="elh_SERVICIOS_escuela" for="x_escuela" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->escuela->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->escuela->CellAttributes() ?>>
<span id="el_SERVICIOS_escuela">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($SERVICIOS->escuela->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $SERVICIOS->escuela->ViewValue ?>
	</span>
	<?php if (!$SERVICIOS->escuela->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_escuela" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $SERVICIOS->escuela->RadioButtonListHtml(TRUE, "x_escuela") ?>
		</div>
	</div>
	<div id="tp_x_escuela" class="ewTemplate"><input type="radio" data-table="SERVICIOS" data-field="x_escuela" data-value-separator="<?php echo $SERVICIOS->escuela->DisplayValueSeparatorAttribute() ?>" name="x_escuela" id="x_escuela" value="{value}"<?php echo $SERVICIOS->escuela->EditAttributes() ?>></div>
</div>
</span>
<?php echo $SERVICIOS->escuela->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SERVICIOS->cargo->Visible) { // cargo ?>
	<div id="r_cargo" class="form-group">
		<label id="elh_SERVICIOS_cargo" for="x_cargo" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->cargo->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->cargo->CellAttributes() ?>>
<span id="el_SERVICIOS_cargo">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($SERVICIOS->cargo->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $SERVICIOS->cargo->ViewValue ?>
	</span>
	<?php if (!$SERVICIOS->cargo->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_cargo" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $SERVICIOS->cargo->RadioButtonListHtml(TRUE, "x_cargo") ?>
		</div>
	</div>
	<div id="tp_x_cargo" class="ewTemplate"><input type="radio" data-table="SERVICIOS" data-field="x_cargo" data-value-separator="<?php echo $SERVICIOS->cargo->DisplayValueSeparatorAttribute() ?>" name="x_cargo" id="x_cargo" value="{value}"<?php echo $SERVICIOS->cargo->EditAttributes() ?>></div>
</div>
</span>
<?php echo $SERVICIOS->cargo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SERVICIOS->persona->Visible) { // persona ?>
	<div id="r_persona" class="form-group">
		<label id="elh_SERVICIOS_persona" for="x_persona" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->persona->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->persona->CellAttributes() ?>>
<span id="el_SERVICIOS_persona">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($SERVICIOS->persona->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $SERVICIOS->persona->ViewValue ?>
	</span>
	<?php if (!$SERVICIOS->persona->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_persona" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $SERVICIOS->persona->RadioButtonListHtml(TRUE, "x_persona") ?>
		</div>
	</div>
	<div id="tp_x_persona" class="ewTemplate"><input type="radio" data-table="SERVICIOS" data-field="x_persona" data-value-separator="<?php echo $SERVICIOS->persona->DisplayValueSeparatorAttribute() ?>" name="x_persona" id="x_persona" value="{value}"<?php echo $SERVICIOS->persona->EditAttributes() ?>></div>
</div>
</span>
<?php echo $SERVICIOS->persona->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SERVICIOS->fecha_alta->Visible) { // fecha_alta ?>
	<div id="r_fecha_alta" class="form-group">
		<label id="elh_SERVICIOS_fecha_alta" for="x_fecha_alta" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->fecha_alta->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->fecha_alta->CellAttributes() ?>>
<span id="el_SERVICIOS_fecha_alta">
<input type="text" data-table="SERVICIOS" data-field="x_fecha_alta" name="x_fecha_alta" id="x_fecha_alta" placeholder="<?php echo ew_HtmlEncode($SERVICIOS->fecha_alta->getPlaceHolder()) ?>" value="<?php echo $SERVICIOS->fecha_alta->EditValue ?>"<?php echo $SERVICIOS->fecha_alta->EditAttributes() ?>>
</span>
<?php echo $SERVICIOS->fecha_alta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SERVICIOS->fecha_baja->Visible) { // fecha_baja ?>
	<div id="r_fecha_baja" class="form-group">
		<label id="elh_SERVICIOS_fecha_baja" for="x_fecha_baja" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->fecha_baja->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->fecha_baja->CellAttributes() ?>>
<span id="el_SERVICIOS_fecha_baja">
<input type="text" data-table="SERVICIOS" data-field="x_fecha_baja" name="x_fecha_baja" id="x_fecha_baja" placeholder="<?php echo ew_HtmlEncode($SERVICIOS->fecha_baja->getPlaceHolder()) ?>" value="<?php echo $SERVICIOS->fecha_baja->EditValue ?>"<?php echo $SERVICIOS->fecha_baja->EditAttributes() ?>>
</span>
<?php echo $SERVICIOS->fecha_baja->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($SERVICIOS->activo->Visible) { // activo ?>
	<div id="r_activo" class="form-group">
		<label id="elh_SERVICIOS_activo" class="<?php echo $SERVICIOS_edit->LeftColumnClass ?>"><?php echo $SERVICIOS->activo->FldCaption() ?></label>
		<div class="<?php echo $SERVICIOS_edit->RightColumnClass ?>"><div<?php echo $SERVICIOS->activo->CellAttributes() ?>>
<span id="el_SERVICIOS_activo">
<div id="tp_x_activo" class="ewTemplate"><input type="radio" data-table="SERVICIOS" data-field="x_activo" data-value-separator="<?php echo $SERVICIOS->activo->DisplayValueSeparatorAttribute() ?>" name="x_activo" id="x_activo" value="{value}"<?php echo $SERVICIOS->activo->EditAttributes() ?>></div>
<div id="dsl_x_activo" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $SERVICIOS->activo->RadioButtonListHtml(FALSE, "x_activo") ?>
</div></div>
</span>
<?php echo $SERVICIOS->activo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$SERVICIOS_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $SERVICIOS_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $SERVICIOS_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fSERVICIOSedit.Init();
</script>
<?php
$SERVICIOS_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$SERVICIOS_edit->Page_Terminate();
?>
