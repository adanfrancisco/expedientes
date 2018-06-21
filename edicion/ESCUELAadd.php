<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "ESCUELAinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$ESCUELA_add = NULL; // Initialize page object first

class cESCUELA_add extends cESCUELA {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{803A0725-AF43-41D4-9FF6-CD1AEBA17FEC}';

	// Table name
	var $TableName = 'ESCUELA';

	// Page object name
	var $PageObjName = 'ESCUELA_add';

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

		// Table object (ESCUELA)
		if (!isset($GLOBALS["ESCUELA"]) || get_class($GLOBALS["ESCUELA"]) == "cESCUELA") {
			$GLOBALS["ESCUELA"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ESCUELA"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ESCUELA', TRUE);

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
		$this->CLAVE->SetVisibility();
		$this->CUE->SetVisibility();
		$this->NOMBRE->SetVisibility();
		$this->DOMICILIO->SetVisibility();
		$this->LOCALIDAD->SetVisibility();
		$this->TELEFONO->SetVisibility();
		$this->NIVEL->SetVisibility();
		$this->RPV->SetVisibility();

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
		global $EW_EXPORT, $ESCUELA;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($ESCUELA);
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
					if ($pageName == "ESCUELAview.php")
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["CLAVE"] != "") {
				$this->CLAVE->setQueryStringValue($_GET["CLAVE"]);
				$this->setKey("CLAVE", $this->CLAVE->CurrentValue); // Set up key
			} else {
				$this->setKey("CLAVE", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("ESCUELAlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "ESCUELAlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "ESCUELAview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->CLAVE->CurrentValue = NULL;
		$this->CLAVE->OldValue = $this->CLAVE->CurrentValue;
		$this->CUE->CurrentValue = NULL;
		$this->CUE->OldValue = $this->CUE->CurrentValue;
		$this->NOMBRE->CurrentValue = NULL;
		$this->NOMBRE->OldValue = $this->NOMBRE->CurrentValue;
		$this->DOMICILIO->CurrentValue = NULL;
		$this->DOMICILIO->OldValue = $this->DOMICILIO->CurrentValue;
		$this->LOCALIDAD->CurrentValue = 0;
		$this->TELEFONO->CurrentValue = NULL;
		$this->TELEFONO->OldValue = $this->TELEFONO->CurrentValue;
		$this->NIVEL->CurrentValue = 0;
		$this->RPV->CurrentValue = NULL;
		$this->RPV->OldValue = $this->RPV->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->CLAVE->FldIsDetailKey) {
			$this->CLAVE->setFormValue($objForm->GetValue("x_CLAVE"));
		}
		if (!$this->CUE->FldIsDetailKey) {
			$this->CUE->setFormValue($objForm->GetValue("x_CUE"));
		}
		if (!$this->NOMBRE->FldIsDetailKey) {
			$this->NOMBRE->setFormValue($objForm->GetValue("x_NOMBRE"));
		}
		if (!$this->DOMICILIO->FldIsDetailKey) {
			$this->DOMICILIO->setFormValue($objForm->GetValue("x_DOMICILIO"));
		}
		if (!$this->LOCALIDAD->FldIsDetailKey) {
			$this->LOCALIDAD->setFormValue($objForm->GetValue("x_LOCALIDAD"));
		}
		if (!$this->TELEFONO->FldIsDetailKey) {
			$this->TELEFONO->setFormValue($objForm->GetValue("x_TELEFONO"));
		}
		if (!$this->NIVEL->FldIsDetailKey) {
			$this->NIVEL->setFormValue($objForm->GetValue("x_NIVEL"));
		}
		if (!$this->RPV->FldIsDetailKey) {
			$this->RPV->setFormValue($objForm->GetValue("x_RPV"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->CLAVE->CurrentValue = $this->CLAVE->FormValue;
		$this->CUE->CurrentValue = $this->CUE->FormValue;
		$this->NOMBRE->CurrentValue = $this->NOMBRE->FormValue;
		$this->DOMICILIO->CurrentValue = $this->DOMICILIO->FormValue;
		$this->LOCALIDAD->CurrentValue = $this->LOCALIDAD->FormValue;
		$this->TELEFONO->CurrentValue = $this->TELEFONO->FormValue;
		$this->NIVEL->CurrentValue = $this->NIVEL->FormValue;
		$this->RPV->CurrentValue = $this->RPV->FormValue;
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
		$this->CLAVE->setDbValue($row['CLAVE']);
		$this->CUE->setDbValue($row['CUE']);
		$this->NOMBRE->setDbValue($row['NOMBRE']);
		$this->DOMICILIO->setDbValue($row['DOMICILIO']);
		$this->LOCALIDAD->setDbValue($row['LOCALIDAD']);
		$this->TELEFONO->setDbValue($row['TELEFONO']);
		$this->NIVEL->setDbValue($row['NIVEL']);
		$this->RPV->setDbValue($row['RPV']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['CLAVE'] = $this->CLAVE->CurrentValue;
		$row['CUE'] = $this->CUE->CurrentValue;
		$row['NOMBRE'] = $this->NOMBRE->CurrentValue;
		$row['DOMICILIO'] = $this->DOMICILIO->CurrentValue;
		$row['LOCALIDAD'] = $this->LOCALIDAD->CurrentValue;
		$row['TELEFONO'] = $this->TELEFONO->CurrentValue;
		$row['NIVEL'] = $this->NIVEL->CurrentValue;
		$row['RPV'] = $this->RPV->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->CLAVE->DbValue = $row['CLAVE'];
		$this->CUE->DbValue = $row['CUE'];
		$this->NOMBRE->DbValue = $row['NOMBRE'];
		$this->DOMICILIO->DbValue = $row['DOMICILIO'];
		$this->LOCALIDAD->DbValue = $row['LOCALIDAD'];
		$this->TELEFONO->DbValue = $row['TELEFONO'];
		$this->NIVEL->DbValue = $row['NIVEL'];
		$this->RPV->DbValue = $row['RPV'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("CLAVE")) <> "")
			$this->CLAVE->CurrentValue = $this->getKey("CLAVE"); // CLAVE
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
		// CLAVE
		// CUE
		// NOMBRE
		// DOMICILIO
		// LOCALIDAD
		// TELEFONO
		// NIVEL
		// RPV

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// CLAVE
		$this->CLAVE->ViewValue = $this->CLAVE->CurrentValue;
		$this->CLAVE->ViewCustomAttributes = "";

		// CUE
		$this->CUE->ViewValue = $this->CUE->CurrentValue;
		$this->CUE->ViewCustomAttributes = "";

		// NOMBRE
		$this->NOMBRE->ViewValue = $this->NOMBRE->CurrentValue;
		$this->NOMBRE->ViewCustomAttributes = "";

		// DOMICILIO
		$this->DOMICILIO->ViewValue = $this->DOMICILIO->CurrentValue;
		$this->DOMICILIO->ViewCustomAttributes = "";

		// LOCALIDAD
		if (strval($this->LOCALIDAD->CurrentValue) <> "") {
			$sFilterWrk = "[idLocalidad]" . ew_SearchString("=", $this->LOCALIDAD->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT [idLocalidad], [localidad_nombre] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [localidades]";
		$sWhereWrk = "";
		$this->LOCALIDAD->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->LOCALIDAD, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->LOCALIDAD->ViewValue = $this->LOCALIDAD->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->LOCALIDAD->ViewValue = $this->LOCALIDAD->CurrentValue;
			}
		} else {
			$this->LOCALIDAD->ViewValue = NULL;
		}
		$this->LOCALIDAD->ViewCustomAttributes = "";

		// TELEFONO
		$this->TELEFONO->ViewValue = $this->TELEFONO->CurrentValue;
		$this->TELEFONO->ViewCustomAttributes = "";

		// NIVEL
		if (strval($this->NIVEL->CurrentValue) <> "") {
			$sFilterWrk = "[Id_nivel]" . ew_SearchString("=", $this->NIVEL->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT [Id_nivel], [Nivel] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [niveles]";
		$sWhereWrk = "";
		$this->NIVEL->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->NIVEL, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->NIVEL->ViewValue = $this->NIVEL->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->NIVEL->ViewValue = $this->NIVEL->CurrentValue;
			}
		} else {
			$this->NIVEL->ViewValue = NULL;
		}
		$this->NIVEL->ViewCustomAttributes = "";

		// RPV
		$this->RPV->ViewValue = $this->RPV->CurrentValue;
		$this->RPV->ViewCustomAttributes = "";

			// CLAVE
			$this->CLAVE->LinkCustomAttributes = "";
			$this->CLAVE->HrefValue = "";
			$this->CLAVE->TooltipValue = "";

			// CUE
			$this->CUE->LinkCustomAttributes = "";
			$this->CUE->HrefValue = "";
			$this->CUE->TooltipValue = "";

			// NOMBRE
			$this->NOMBRE->LinkCustomAttributes = "";
			$this->NOMBRE->HrefValue = "";
			$this->NOMBRE->TooltipValue = "";

			// DOMICILIO
			$this->DOMICILIO->LinkCustomAttributes = "";
			$this->DOMICILIO->HrefValue = "";
			$this->DOMICILIO->TooltipValue = "";

			// LOCALIDAD
			$this->LOCALIDAD->LinkCustomAttributes = "";
			$this->LOCALIDAD->HrefValue = "";
			$this->LOCALIDAD->TooltipValue = "";

			// TELEFONO
			$this->TELEFONO->LinkCustomAttributes = "";
			$this->TELEFONO->HrefValue = "";
			$this->TELEFONO->TooltipValue = "";

			// NIVEL
			$this->NIVEL->LinkCustomAttributes = "";
			$this->NIVEL->HrefValue = "";
			$this->NIVEL->TooltipValue = "";

			// RPV
			$this->RPV->LinkCustomAttributes = "";
			$this->RPV->HrefValue = "";
			$this->RPV->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// CLAVE
			$this->CLAVE->EditAttrs["class"] = "form-control";
			$this->CLAVE->EditCustomAttributes = "";
			$this->CLAVE->EditValue = ew_HtmlEncode($this->CLAVE->CurrentValue);
			$this->CLAVE->PlaceHolder = ew_RemoveHtml($this->CLAVE->FldCaption());

			// CUE
			$this->CUE->EditAttrs["class"] = "form-control";
			$this->CUE->EditCustomAttributes = "";
			$this->CUE->EditValue = ew_HtmlEncode($this->CUE->CurrentValue);
			$this->CUE->PlaceHolder = ew_RemoveHtml($this->CUE->FldCaption());

			// NOMBRE
			$this->NOMBRE->EditAttrs["class"] = "form-control";
			$this->NOMBRE->EditCustomAttributes = "";
			$this->NOMBRE->EditValue = ew_HtmlEncode($this->NOMBRE->CurrentValue);
			$this->NOMBRE->PlaceHolder = ew_RemoveHtml($this->NOMBRE->FldCaption());

			// DOMICILIO
			$this->DOMICILIO->EditAttrs["class"] = "form-control";
			$this->DOMICILIO->EditCustomAttributes = "";
			$this->DOMICILIO->EditValue = ew_HtmlEncode($this->DOMICILIO->CurrentValue);
			$this->DOMICILIO->PlaceHolder = ew_RemoveHtml($this->DOMICILIO->FldCaption());

			// LOCALIDAD
			$this->LOCALIDAD->EditAttrs["class"] = "form-control";
			$this->LOCALIDAD->EditCustomAttributes = "";
			if (trim(strval($this->LOCALIDAD->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[idLocalidad]" . ew_SearchString("=", $this->LOCALIDAD->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT [idLocalidad], [localidad_nombre] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [localidades]";
			$sWhereWrk = "";
			$this->LOCALIDAD->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->LOCALIDAD, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->LOCALIDAD->EditValue = $arwrk;

			// TELEFONO
			$this->TELEFONO->EditAttrs["class"] = "form-control";
			$this->TELEFONO->EditCustomAttributes = "";
			$this->TELEFONO->EditValue = ew_HtmlEncode($this->TELEFONO->CurrentValue);
			$this->TELEFONO->PlaceHolder = ew_RemoveHtml($this->TELEFONO->FldCaption());

			// NIVEL
			$this->NIVEL->EditCustomAttributes = "";
			if (trim(strval($this->NIVEL->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "[Id_nivel]" . ew_SearchString("=", $this->NIVEL->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT [Id_nivel], [Nivel] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld], '' AS [SelectFilterFld], '' AS [SelectFilterFld2], '' AS [SelectFilterFld3], '' AS [SelectFilterFld4] FROM [niveles]";
			$sWhereWrk = "";
			$this->NIVEL->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->NIVEL, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->NIVEL->ViewValue = $this->NIVEL->DisplayValue($arwrk);
			} else {
				$this->NIVEL->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->NIVEL->EditValue = $arwrk;

			// RPV
			$this->RPV->EditAttrs["class"] = "form-control";
			$this->RPV->EditCustomAttributes = "";
			$this->RPV->EditValue = ew_HtmlEncode($this->RPV->CurrentValue);
			$this->RPV->PlaceHolder = ew_RemoveHtml($this->RPV->FldCaption());

			// Add refer script
			// CLAVE

			$this->CLAVE->LinkCustomAttributes = "";
			$this->CLAVE->HrefValue = "";

			// CUE
			$this->CUE->LinkCustomAttributes = "";
			$this->CUE->HrefValue = "";

			// NOMBRE
			$this->NOMBRE->LinkCustomAttributes = "";
			$this->NOMBRE->HrefValue = "";

			// DOMICILIO
			$this->DOMICILIO->LinkCustomAttributes = "";
			$this->DOMICILIO->HrefValue = "";

			// LOCALIDAD
			$this->LOCALIDAD->LinkCustomAttributes = "";
			$this->LOCALIDAD->HrefValue = "";

			// TELEFONO
			$this->TELEFONO->LinkCustomAttributes = "";
			$this->TELEFONO->HrefValue = "";

			// NIVEL
			$this->NIVEL->LinkCustomAttributes = "";
			$this->NIVEL->HrefValue = "";

			// RPV
			$this->RPV->LinkCustomAttributes = "";
			$this->RPV->HrefValue = "";
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
		if (!$this->CLAVE->FldIsDetailKey && !is_null($this->CLAVE->FormValue) && $this->CLAVE->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->CLAVE->FldCaption(), $this->CLAVE->ReqErrMsg));
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		if ($this->CLAVE->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(CLAVE = '" . ew_AdjustSql($this->CLAVE->CurrentValue, $this->DBID) . "')";
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", $this->CLAVE->FldCaption(), $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $this->CLAVE->CurrentValue, $sIdxErrMsg);
				$this->setFailureMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// CLAVE
		$this->CLAVE->SetDbValueDef($rsnew, $this->CLAVE->CurrentValue, NULL, FALSE);

		// CUE
		$this->CUE->SetDbValueDef($rsnew, $this->CUE->CurrentValue, NULL, FALSE);

		// NOMBRE
		$this->NOMBRE->SetDbValueDef($rsnew, $this->NOMBRE->CurrentValue, NULL, FALSE);

		// DOMICILIO
		$this->DOMICILIO->SetDbValueDef($rsnew, $this->DOMICILIO->CurrentValue, NULL, FALSE);

		// LOCALIDAD
		$this->LOCALIDAD->SetDbValueDef($rsnew, $this->LOCALIDAD->CurrentValue, NULL, strval($this->LOCALIDAD->CurrentValue) == "");

		// TELEFONO
		$this->TELEFONO->SetDbValueDef($rsnew, $this->TELEFONO->CurrentValue, NULL, FALSE);

		// NIVEL
		$this->NIVEL->SetDbValueDef($rsnew, $this->NIVEL->CurrentValue, NULL, strval($this->NIVEL->CurrentValue) == "");

		// RPV
		$this->RPV->SetDbValueDef($rsnew, $this->RPV->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($bInsertRow && $this->ValidateKey && strval($rsnew['CLAVE']) == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			$bInsertRow = FALSE;
		}

		// Check for duplicate key
		if ($bInsertRow && $this->ValidateKey) {
			$sFilter = $this->KeyFilter();
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				$bInsertRow = FALSE;
			}
		}
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("ESCUELAlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_LOCALIDAD":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT [idLocalidad] AS [LinkFld], [localidad_nombre] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [localidades]";
			$sWhereWrk = "";
			$this->LOCALIDAD->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '[idLocalidad] IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->LOCALIDAD, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_NIVEL":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT [Id_nivel] AS [LinkFld], [Nivel] AS [DispFld], '' AS [Disp2Fld], '' AS [Disp3Fld], '' AS [Disp4Fld] FROM [niveles]";
			$sWhereWrk = "";
			$this->NIVEL->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '[Id_nivel] IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->NIVEL, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($ESCUELA_add)) $ESCUELA_add = new cESCUELA_add();

// Page init
$ESCUELA_add->Page_Init();

// Page main
$ESCUELA_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ESCUELA_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fESCUELAadd = new ew_Form("fESCUELAadd", "add");

// Validate form
fESCUELAadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_CLAVE");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $ESCUELA->CLAVE->FldCaption(), $ESCUELA->CLAVE->ReqErrMsg)) ?>");

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
fESCUELAadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fESCUELAadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fESCUELAadd.Lists["x_LOCALIDAD"] = {"LinkField":"x_idLocalidad","Ajax":true,"AutoFill":false,"DisplayFields":["x_localidad_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"localidades"};
fESCUELAadd.Lists["x_LOCALIDAD"].Data = "<?php echo $ESCUELA_add->LOCALIDAD->LookupFilterQuery(FALSE, "add") ?>";
fESCUELAadd.Lists["x_NIVEL"] = {"LinkField":"x_Id_nivel","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nivel","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"niveles"};
fESCUELAadd.Lists["x_NIVEL"].Data = "<?php echo $ESCUELA_add->NIVEL->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $ESCUELA_add->ShowPageHeader(); ?>
<?php
$ESCUELA_add->ShowMessage();
?>
<form name="fESCUELAadd" id="fESCUELAadd" class="<?php echo $ESCUELA_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($ESCUELA_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $ESCUELA_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ESCUELA">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($ESCUELA_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($ESCUELA->CLAVE->Visible) { // CLAVE ?>
	<div id="r_CLAVE" class="form-group">
		<label id="elh_ESCUELA_CLAVE" for="x_CLAVE" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->CLAVE->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->CLAVE->CellAttributes() ?>>
<span id="el_ESCUELA_CLAVE">
<input type="text" data-table="ESCUELA" data-field="x_CLAVE" name="x_CLAVE" id="x_CLAVE" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($ESCUELA->CLAVE->getPlaceHolder()) ?>" value="<?php echo $ESCUELA->CLAVE->EditValue ?>"<?php echo $ESCUELA->CLAVE->EditAttributes() ?>>
</span>
<?php echo $ESCUELA->CLAVE->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->CUE->Visible) { // CUE ?>
	<div id="r_CUE" class="form-group">
		<label id="elh_ESCUELA_CUE" for="x_CUE" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->CUE->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->CUE->CellAttributes() ?>>
<span id="el_ESCUELA_CUE">
<input type="text" data-table="ESCUELA" data-field="x_CUE" name="x_CUE" id="x_CUE" size="30" maxlength="9" placeholder="<?php echo ew_HtmlEncode($ESCUELA->CUE->getPlaceHolder()) ?>" value="<?php echo $ESCUELA->CUE->EditValue ?>"<?php echo $ESCUELA->CUE->EditAttributes() ?>>
</span>
<?php echo $ESCUELA->CUE->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->NOMBRE->Visible) { // NOMBRE ?>
	<div id="r_NOMBRE" class="form-group">
		<label id="elh_ESCUELA_NOMBRE" for="x_NOMBRE" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->NOMBRE->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->NOMBRE->CellAttributes() ?>>
<span id="el_ESCUELA_NOMBRE">
<textarea data-table="ESCUELA" data-field="x_NOMBRE" name="x_NOMBRE" id="x_NOMBRE" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($ESCUELA->NOMBRE->getPlaceHolder()) ?>"<?php echo $ESCUELA->NOMBRE->EditAttributes() ?>><?php echo $ESCUELA->NOMBRE->EditValue ?></textarea>
</span>
<?php echo $ESCUELA->NOMBRE->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->DOMICILIO->Visible) { // DOMICILIO ?>
	<div id="r_DOMICILIO" class="form-group">
		<label id="elh_ESCUELA_DOMICILIO" for="x_DOMICILIO" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->DOMICILIO->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->DOMICILIO->CellAttributes() ?>>
<span id="el_ESCUELA_DOMICILIO">
<input type="text" data-table="ESCUELA" data-field="x_DOMICILIO" name="x_DOMICILIO" id="x_DOMICILIO" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($ESCUELA->DOMICILIO->getPlaceHolder()) ?>" value="<?php echo $ESCUELA->DOMICILIO->EditValue ?>"<?php echo $ESCUELA->DOMICILIO->EditAttributes() ?>>
</span>
<?php echo $ESCUELA->DOMICILIO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->LOCALIDAD->Visible) { // LOCALIDAD ?>
	<div id="r_LOCALIDAD" class="form-group">
		<label id="elh_ESCUELA_LOCALIDAD" for="x_LOCALIDAD" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->LOCALIDAD->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->LOCALIDAD->CellAttributes() ?>>
<span id="el_ESCUELA_LOCALIDAD">
<select data-table="ESCUELA" data-field="x_LOCALIDAD" data-value-separator="<?php echo $ESCUELA->LOCALIDAD->DisplayValueSeparatorAttribute() ?>" id="x_LOCALIDAD" name="x_LOCALIDAD"<?php echo $ESCUELA->LOCALIDAD->EditAttributes() ?>>
<?php echo $ESCUELA->LOCALIDAD->SelectOptionListHtml("x_LOCALIDAD") ?>
</select>
</span>
<?php echo $ESCUELA->LOCALIDAD->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->TELEFONO->Visible) { // TELEFONO ?>
	<div id="r_TELEFONO" class="form-group">
		<label id="elh_ESCUELA_TELEFONO" for="x_TELEFONO" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->TELEFONO->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->TELEFONO->CellAttributes() ?>>
<span id="el_ESCUELA_TELEFONO">
<input type="text" data-table="ESCUELA" data-field="x_TELEFONO" name="x_TELEFONO" id="x_TELEFONO" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($ESCUELA->TELEFONO->getPlaceHolder()) ?>" value="<?php echo $ESCUELA->TELEFONO->EditValue ?>"<?php echo $ESCUELA->TELEFONO->EditAttributes() ?>>
</span>
<?php echo $ESCUELA->TELEFONO->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->NIVEL->Visible) { // NIVEL ?>
	<div id="r_NIVEL" class="form-group">
		<label id="elh_ESCUELA_NIVEL" for="x_NIVEL" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->NIVEL->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->NIVEL->CellAttributes() ?>>
<span id="el_ESCUELA_NIVEL">
<div class="ewDropdownList has-feedback">
	<span onclick="" class="form-control dropdown-toggle" aria-expanded="false"<?php if ($ESCUELA->NIVEL->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>>
		<?php echo $ESCUELA->NIVEL->ViewValue ?>
	</span>
	<?php if (!$ESCUELA->NIVEL->ReadOnly) { ?>
	<span class="glyphicon glyphicon-remove form-control-feedback ewDropdownListClear"></span>
	<span class="form-control-feedback"><span class="caret"></span></span>
	<?php } ?>
	<div id="dsl_x_NIVEL" data-repeatcolumn="1" class="dropdown-menu">
		<div class="ewItems" style="position: relative; overflow-x: hidden;">
<?php echo $ESCUELA->NIVEL->RadioButtonListHtml(TRUE, "x_NIVEL") ?>
		</div>
	</div>
	<div id="tp_x_NIVEL" class="ewTemplate"><input type="radio" data-table="ESCUELA" data-field="x_NIVEL" data-value-separator="<?php echo $ESCUELA->NIVEL->DisplayValueSeparatorAttribute() ?>" name="x_NIVEL" id="x_NIVEL" value="{value}"<?php echo $ESCUELA->NIVEL->EditAttributes() ?>></div>
</div>
</span>
<?php echo $ESCUELA->NIVEL->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ESCUELA->RPV->Visible) { // RPV ?>
	<div id="r_RPV" class="form-group">
		<label id="elh_ESCUELA_RPV" for="x_RPV" class="<?php echo $ESCUELA_add->LeftColumnClass ?>"><?php echo $ESCUELA->RPV->FldCaption() ?></label>
		<div class="<?php echo $ESCUELA_add->RightColumnClass ?>"><div<?php echo $ESCUELA->RPV->CellAttributes() ?>>
<span id="el_ESCUELA_RPV">
<input type="text" data-table="ESCUELA" data-field="x_RPV" name="x_RPV" id="x_RPV" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($ESCUELA->RPV->getPlaceHolder()) ?>" value="<?php echo $ESCUELA->RPV->EditValue ?>"<?php echo $ESCUELA->RPV->EditAttributes() ?>>
</span>
<?php echo $ESCUELA->RPV->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ESCUELA_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $ESCUELA_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $ESCUELA_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fESCUELAadd.Init();
</script>
<?php
$ESCUELA_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ESCUELA_add->Page_Terminate();
?>
