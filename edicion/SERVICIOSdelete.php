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

$SERVICIOS_delete = NULL; // Initialize page object first

class cSERVICIOS_delete extends cSERVICIOS {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{803A0725-AF43-41D4-9FF6-CD1AEBA17FEC}';

	// Table name
	var $TableName = 'SERVICIOS';

	// Page object name
	var $PageObjName = 'SERVICIOS_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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
			$this->Page_Terminate("SERVICIOSlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in SERVICIOS class, SERVICIOSinfo.php

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
				$this->Page_Terminate("SERVICIOSlist.php"); // Return to list
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
				$sThisKey .= $row['id_servicio'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("SERVICIOSlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($SERVICIOS_delete)) $SERVICIOS_delete = new cSERVICIOS_delete();

// Page init
$SERVICIOS_delete->Page_Init();

// Page main
$SERVICIOS_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SERVICIOS_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fSERVICIOSdelete = new ew_Form("fSERVICIOSdelete", "delete");

// Form_CustomValidate event
fSERVICIOSdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fSERVICIOSdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fSERVICIOSdelete.Lists["x_escuela"] = {"LinkField":"x_CLAVE","Ajax":true,"AutoFill":false,"DisplayFields":["x_CLAVE","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"ESCUELA"};
fSERVICIOSdelete.Lists["x_escuela"].Data = "<?php echo $SERVICIOS_delete->escuela->LookupFilterQuery(FALSE, "delete") ?>";
fSERVICIOSdelete.Lists["x_cargo"] = {"LinkField":"x_id_cargo","Ajax":true,"AutoFill":false,"DisplayFields":["x_cargo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cargos"};
fSERVICIOSdelete.Lists["x_cargo"].Data = "<?php echo $SERVICIOS_delete->cargo->LookupFilterQuery(FALSE, "delete") ?>";
fSERVICIOSdelete.Lists["x_persona"] = {"LinkField":"x_id_persona","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"persona"};
fSERVICIOSdelete.Lists["x_persona"].Data = "<?php echo $SERVICIOS_delete->persona->LookupFilterQuery(FALSE, "delete") ?>";
fSERVICIOSdelete.Lists["x_activo"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fSERVICIOSdelete.Lists["x_activo"].Options = <?php echo json_encode($SERVICIOS_delete->activo->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $SERVICIOS_delete->ShowPageHeader(); ?>
<?php
$SERVICIOS_delete->ShowMessage();
?>
<form name="fSERVICIOSdelete" id="fSERVICIOSdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($SERVICIOS_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $SERVICIOS_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SERVICIOS">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($SERVICIOS_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($SERVICIOS->id_servicio->Visible) { // id_servicio ?>
		<th class="<?php echo $SERVICIOS->id_servicio->HeaderCellClass() ?>"><span id="elh_SERVICIOS_id_servicio" class="SERVICIOS_id_servicio"><?php echo $SERVICIOS->id_servicio->FldCaption() ?></span></th>
<?php } ?>
<?php if ($SERVICIOS->escuela->Visible) { // escuela ?>
		<th class="<?php echo $SERVICIOS->escuela->HeaderCellClass() ?>"><span id="elh_SERVICIOS_escuela" class="SERVICIOS_escuela"><?php echo $SERVICIOS->escuela->FldCaption() ?></span></th>
<?php } ?>
<?php if ($SERVICIOS->cargo->Visible) { // cargo ?>
		<th class="<?php echo $SERVICIOS->cargo->HeaderCellClass() ?>"><span id="elh_SERVICIOS_cargo" class="SERVICIOS_cargo"><?php echo $SERVICIOS->cargo->FldCaption() ?></span></th>
<?php } ?>
<?php if ($SERVICIOS->persona->Visible) { // persona ?>
		<th class="<?php echo $SERVICIOS->persona->HeaderCellClass() ?>"><span id="elh_SERVICIOS_persona" class="SERVICIOS_persona"><?php echo $SERVICIOS->persona->FldCaption() ?></span></th>
<?php } ?>
<?php if ($SERVICIOS->fecha_alta->Visible) { // fecha_alta ?>
		<th class="<?php echo $SERVICIOS->fecha_alta->HeaderCellClass() ?>"><span id="elh_SERVICIOS_fecha_alta" class="SERVICIOS_fecha_alta"><?php echo $SERVICIOS->fecha_alta->FldCaption() ?></span></th>
<?php } ?>
<?php if ($SERVICIOS->fecha_baja->Visible) { // fecha_baja ?>
		<th class="<?php echo $SERVICIOS->fecha_baja->HeaderCellClass() ?>"><span id="elh_SERVICIOS_fecha_baja" class="SERVICIOS_fecha_baja"><?php echo $SERVICIOS->fecha_baja->FldCaption() ?></span></th>
<?php } ?>
<?php if ($SERVICIOS->activo->Visible) { // activo ?>
		<th class="<?php echo $SERVICIOS->activo->HeaderCellClass() ?>"><span id="elh_SERVICIOS_activo" class="SERVICIOS_activo"><?php echo $SERVICIOS->activo->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$SERVICIOS_delete->RecCnt = 0;
$i = 0;
while (!$SERVICIOS_delete->Recordset->EOF) {
	$SERVICIOS_delete->RecCnt++;
	$SERVICIOS_delete->RowCnt++;

	// Set row properties
	$SERVICIOS->ResetAttrs();
	$SERVICIOS->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$SERVICIOS_delete->LoadRowValues($SERVICIOS_delete->Recordset);

	// Render row
	$SERVICIOS_delete->RenderRow();
?>
	<tr<?php echo $SERVICIOS->RowAttributes() ?>>
<?php if ($SERVICIOS->id_servicio->Visible) { // id_servicio ?>
		<td<?php echo $SERVICIOS->id_servicio->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_id_servicio" class="SERVICIOS_id_servicio">
<span<?php echo $SERVICIOS->id_servicio->ViewAttributes() ?>>
<?php echo $SERVICIOS->id_servicio->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SERVICIOS->escuela->Visible) { // escuela ?>
		<td<?php echo $SERVICIOS->escuela->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_escuela" class="SERVICIOS_escuela">
<span<?php echo $SERVICIOS->escuela->ViewAttributes() ?>>
<?php echo $SERVICIOS->escuela->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SERVICIOS->cargo->Visible) { // cargo ?>
		<td<?php echo $SERVICIOS->cargo->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_cargo" class="SERVICIOS_cargo">
<span<?php echo $SERVICIOS->cargo->ViewAttributes() ?>>
<?php echo $SERVICIOS->cargo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SERVICIOS->persona->Visible) { // persona ?>
		<td<?php echo $SERVICIOS->persona->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_persona" class="SERVICIOS_persona">
<span<?php echo $SERVICIOS->persona->ViewAttributes() ?>>
<?php echo $SERVICIOS->persona->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SERVICIOS->fecha_alta->Visible) { // fecha_alta ?>
		<td<?php echo $SERVICIOS->fecha_alta->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_fecha_alta" class="SERVICIOS_fecha_alta">
<span<?php echo $SERVICIOS->fecha_alta->ViewAttributes() ?>>
<?php echo $SERVICIOS->fecha_alta->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SERVICIOS->fecha_baja->Visible) { // fecha_baja ?>
		<td<?php echo $SERVICIOS->fecha_baja->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_fecha_baja" class="SERVICIOS_fecha_baja">
<span<?php echo $SERVICIOS->fecha_baja->ViewAttributes() ?>>
<?php echo $SERVICIOS->fecha_baja->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($SERVICIOS->activo->Visible) { // activo ?>
		<td<?php echo $SERVICIOS->activo->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_delete->RowCnt ?>_SERVICIOS_activo" class="SERVICIOS_activo">
<span<?php echo $SERVICIOS->activo->ViewAttributes() ?>>
<?php echo $SERVICIOS->activo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$SERVICIOS_delete->Recordset->MoveNext();
}
$SERVICIOS_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $SERVICIOS_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fSERVICIOSdelete.Init();
</script>
<?php
$SERVICIOS_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$SERVICIOS_delete->Page_Terminate();
?>
