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

$ESCUELA_delete = NULL; // Initialize page object first

class cESCUELA_delete extends cESCUELA {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{803A0725-AF43-41D4-9FF6-CD1AEBA17FEC}';

	// Table name
	var $TableName = 'ESCUELA';

	// Page object name
	var $PageObjName = 'ESCUELA_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->CLAVE->SetVisibility();
		$this->CUE->SetVisibility();
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("ESCUELAlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in ESCUELA class, ESCUELAinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("ESCUELAlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$row = array();
		$row['CLAVE'] = NULL;
		$row['CUE'] = NULL;
		$row['NOMBRE'] = NULL;
		$row['DOMICILIO'] = NULL;
		$row['LOCALIDAD'] = NULL;
		$row['TELEFONO'] = NULL;
		$row['NIVEL'] = NULL;
		$row['RPV'] = NULL;
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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['CLAVE'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("ESCUELAlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($ESCUELA_delete)) $ESCUELA_delete = new cESCUELA_delete();

// Page init
$ESCUELA_delete->Page_Init();

// Page main
$ESCUELA_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ESCUELA_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fESCUELAdelete = new ew_Form("fESCUELAdelete", "delete");

// Form_CustomValidate event
fESCUELAdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fESCUELAdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fESCUELAdelete.Lists["x_LOCALIDAD"] = {"LinkField":"x_idLocalidad","Ajax":true,"AutoFill":false,"DisplayFields":["x_localidad_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"localidades"};
fESCUELAdelete.Lists["x_LOCALIDAD"].Data = "<?php echo $ESCUELA_delete->LOCALIDAD->LookupFilterQuery(FALSE, "delete") ?>";
fESCUELAdelete.Lists["x_NIVEL"] = {"LinkField":"x_Id_nivel","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nivel","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"niveles"};
fESCUELAdelete.Lists["x_NIVEL"].Data = "<?php echo $ESCUELA_delete->NIVEL->LookupFilterQuery(FALSE, "delete") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $ESCUELA_delete->ShowPageHeader(); ?>
<?php
$ESCUELA_delete->ShowMessage();
?>
<form name="fESCUELAdelete" id="fESCUELAdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($ESCUELA_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $ESCUELA_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ESCUELA">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($ESCUELA_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($ESCUELA->CLAVE->Visible) { // CLAVE ?>
		<th class="<?php echo $ESCUELA->CLAVE->HeaderCellClass() ?>"><span id="elh_ESCUELA_CLAVE" class="ESCUELA_CLAVE"><?php echo $ESCUELA->CLAVE->FldCaption() ?></span></th>
<?php } ?>
<?php if ($ESCUELA->CUE->Visible) { // CUE ?>
		<th class="<?php echo $ESCUELA->CUE->HeaderCellClass() ?>"><span id="elh_ESCUELA_CUE" class="ESCUELA_CUE"><?php echo $ESCUELA->CUE->FldCaption() ?></span></th>
<?php } ?>
<?php if ($ESCUELA->DOMICILIO->Visible) { // DOMICILIO ?>
		<th class="<?php echo $ESCUELA->DOMICILIO->HeaderCellClass() ?>"><span id="elh_ESCUELA_DOMICILIO" class="ESCUELA_DOMICILIO"><?php echo $ESCUELA->DOMICILIO->FldCaption() ?></span></th>
<?php } ?>
<?php if ($ESCUELA->LOCALIDAD->Visible) { // LOCALIDAD ?>
		<th class="<?php echo $ESCUELA->LOCALIDAD->HeaderCellClass() ?>"><span id="elh_ESCUELA_LOCALIDAD" class="ESCUELA_LOCALIDAD"><?php echo $ESCUELA->LOCALIDAD->FldCaption() ?></span></th>
<?php } ?>
<?php if ($ESCUELA->TELEFONO->Visible) { // TELEFONO ?>
		<th class="<?php echo $ESCUELA->TELEFONO->HeaderCellClass() ?>"><span id="elh_ESCUELA_TELEFONO" class="ESCUELA_TELEFONO"><?php echo $ESCUELA->TELEFONO->FldCaption() ?></span></th>
<?php } ?>
<?php if ($ESCUELA->NIVEL->Visible) { // NIVEL ?>
		<th class="<?php echo $ESCUELA->NIVEL->HeaderCellClass() ?>"><span id="elh_ESCUELA_NIVEL" class="ESCUELA_NIVEL"><?php echo $ESCUELA->NIVEL->FldCaption() ?></span></th>
<?php } ?>
<?php if ($ESCUELA->RPV->Visible) { // RPV ?>
		<th class="<?php echo $ESCUELA->RPV->HeaderCellClass() ?>"><span id="elh_ESCUELA_RPV" class="ESCUELA_RPV"><?php echo $ESCUELA->RPV->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ESCUELA_delete->RecCnt = 0;
$i = 0;
while (!$ESCUELA_delete->Recordset->EOF) {
	$ESCUELA_delete->RecCnt++;
	$ESCUELA_delete->RowCnt++;

	// Set row properties
	$ESCUELA->ResetAttrs();
	$ESCUELA->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$ESCUELA_delete->LoadRowValues($ESCUELA_delete->Recordset);

	// Render row
	$ESCUELA_delete->RenderRow();
?>
	<tr<?php echo $ESCUELA->RowAttributes() ?>>
<?php if ($ESCUELA->CLAVE->Visible) { // CLAVE ?>
		<td<?php echo $ESCUELA->CLAVE->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_CLAVE" class="ESCUELA_CLAVE">
<span<?php echo $ESCUELA->CLAVE->ViewAttributes() ?>>
<?php echo $ESCUELA->CLAVE->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ESCUELA->CUE->Visible) { // CUE ?>
		<td<?php echo $ESCUELA->CUE->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_CUE" class="ESCUELA_CUE">
<span<?php echo $ESCUELA->CUE->ViewAttributes() ?>>
<?php echo $ESCUELA->CUE->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ESCUELA->DOMICILIO->Visible) { // DOMICILIO ?>
		<td<?php echo $ESCUELA->DOMICILIO->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_DOMICILIO" class="ESCUELA_DOMICILIO">
<span<?php echo $ESCUELA->DOMICILIO->ViewAttributes() ?>>
<?php echo $ESCUELA->DOMICILIO->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ESCUELA->LOCALIDAD->Visible) { // LOCALIDAD ?>
		<td<?php echo $ESCUELA->LOCALIDAD->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_LOCALIDAD" class="ESCUELA_LOCALIDAD">
<span<?php echo $ESCUELA->LOCALIDAD->ViewAttributes() ?>>
<?php echo $ESCUELA->LOCALIDAD->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ESCUELA->TELEFONO->Visible) { // TELEFONO ?>
		<td<?php echo $ESCUELA->TELEFONO->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_TELEFONO" class="ESCUELA_TELEFONO">
<span<?php echo $ESCUELA->TELEFONO->ViewAttributes() ?>>
<?php echo $ESCUELA->TELEFONO->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ESCUELA->NIVEL->Visible) { // NIVEL ?>
		<td<?php echo $ESCUELA->NIVEL->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_NIVEL" class="ESCUELA_NIVEL">
<span<?php echo $ESCUELA->NIVEL->ViewAttributes() ?>>
<?php echo $ESCUELA->NIVEL->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ESCUELA->RPV->Visible) { // RPV ?>
		<td<?php echo $ESCUELA->RPV->CellAttributes() ?>>
<span id="el<?php echo $ESCUELA_delete->RowCnt ?>_ESCUELA_RPV" class="ESCUELA_RPV">
<span<?php echo $ESCUELA->RPV->ViewAttributes() ?>>
<?php echo $ESCUELA->RPV->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ESCUELA_delete->Recordset->MoveNext();
}
$ESCUELA_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $ESCUELA_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fESCUELAdelete.Init();
</script>
<?php
$ESCUELA_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ESCUELA_delete->Page_Terminate();
?>
