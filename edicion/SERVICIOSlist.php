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

$SERVICIOS_list = NULL; // Initialize page object first

class cSERVICIOS_list extends cSERVICIOS {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{803A0725-AF43-41D4-9FF6-CD1AEBA17FEC}';

	// Table name
	var $TableName = 'SERVICIOS';

	// Page object name
	var $PageObjName = 'SERVICIOS_list';

	// Grid form hidden field names
	var $FormName = 'fSERVICIOSlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "SERVICIOSadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "SERVICIOSdelete.php";
		$this->MultiUpdateUrl = "SERVICIOSupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fSERVICIOSlistsrch";

		// List actions
		$this->ListActions = new cListActions();
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id_servicio->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id_servicio->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "fSERVICIOSlistsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->id_servicio->AdvancedSearch->ToJson(), ","); // Field id_servicio
		$sFilterList = ew_Concat($sFilterList, $this->escuela->AdvancedSearch->ToJson(), ","); // Field escuela
		$sFilterList = ew_Concat($sFilterList, $this->cargo->AdvancedSearch->ToJson(), ","); // Field cargo
		$sFilterList = ew_Concat($sFilterList, $this->persona->AdvancedSearch->ToJson(), ","); // Field persona
		$sFilterList = ew_Concat($sFilterList, $this->fecha_alta->AdvancedSearch->ToJson(), ","); // Field fecha_alta
		$sFilterList = ew_Concat($sFilterList, $this->fecha_baja->AdvancedSearch->ToJson(), ","); // Field fecha_baja
		$sFilterList = ew_Concat($sFilterList, $this->activo->AdvancedSearch->ToJson(), ","); // Field activo
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "fSERVICIOSlistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field id_servicio
		$this->id_servicio->AdvancedSearch->SearchValue = @$filter["x_id_servicio"];
		$this->id_servicio->AdvancedSearch->SearchOperator = @$filter["z_id_servicio"];
		$this->id_servicio->AdvancedSearch->SearchCondition = @$filter["v_id_servicio"];
		$this->id_servicio->AdvancedSearch->SearchValue2 = @$filter["y_id_servicio"];
		$this->id_servicio->AdvancedSearch->SearchOperator2 = @$filter["w_id_servicio"];
		$this->id_servicio->AdvancedSearch->Save();

		// Field escuela
		$this->escuela->AdvancedSearch->SearchValue = @$filter["x_escuela"];
		$this->escuela->AdvancedSearch->SearchOperator = @$filter["z_escuela"];
		$this->escuela->AdvancedSearch->SearchCondition = @$filter["v_escuela"];
		$this->escuela->AdvancedSearch->SearchValue2 = @$filter["y_escuela"];
		$this->escuela->AdvancedSearch->SearchOperator2 = @$filter["w_escuela"];
		$this->escuela->AdvancedSearch->Save();

		// Field cargo
		$this->cargo->AdvancedSearch->SearchValue = @$filter["x_cargo"];
		$this->cargo->AdvancedSearch->SearchOperator = @$filter["z_cargo"];
		$this->cargo->AdvancedSearch->SearchCondition = @$filter["v_cargo"];
		$this->cargo->AdvancedSearch->SearchValue2 = @$filter["y_cargo"];
		$this->cargo->AdvancedSearch->SearchOperator2 = @$filter["w_cargo"];
		$this->cargo->AdvancedSearch->Save();

		// Field persona
		$this->persona->AdvancedSearch->SearchValue = @$filter["x_persona"];
		$this->persona->AdvancedSearch->SearchOperator = @$filter["z_persona"];
		$this->persona->AdvancedSearch->SearchCondition = @$filter["v_persona"];
		$this->persona->AdvancedSearch->SearchValue2 = @$filter["y_persona"];
		$this->persona->AdvancedSearch->SearchOperator2 = @$filter["w_persona"];
		$this->persona->AdvancedSearch->Save();

		// Field fecha_alta
		$this->fecha_alta->AdvancedSearch->SearchValue = @$filter["x_fecha_alta"];
		$this->fecha_alta->AdvancedSearch->SearchOperator = @$filter["z_fecha_alta"];
		$this->fecha_alta->AdvancedSearch->SearchCondition = @$filter["v_fecha_alta"];
		$this->fecha_alta->AdvancedSearch->SearchValue2 = @$filter["y_fecha_alta"];
		$this->fecha_alta->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_alta"];
		$this->fecha_alta->AdvancedSearch->Save();

		// Field fecha_baja
		$this->fecha_baja->AdvancedSearch->SearchValue = @$filter["x_fecha_baja"];
		$this->fecha_baja->AdvancedSearch->SearchOperator = @$filter["z_fecha_baja"];
		$this->fecha_baja->AdvancedSearch->SearchCondition = @$filter["v_fecha_baja"];
		$this->fecha_baja->AdvancedSearch->SearchValue2 = @$filter["y_fecha_baja"];
		$this->fecha_baja->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_baja"];
		$this->fecha_baja->AdvancedSearch->Save();

		// Field activo
		$this->activo->AdvancedSearch->SearchValue = @$filter["x_activo"];
		$this->activo->AdvancedSearch->SearchOperator = @$filter["z_activo"];
		$this->activo->AdvancedSearch->SearchCondition = @$filter["v_activo"];
		$this->activo->AdvancedSearch->SearchValue2 = @$filter["y_activo"];
		$this->activo->AdvancedSearch->SearchOperator2 = @$filter["w_activo"];
		$this->activo->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->escuela, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->id_servicio); // id_servicio
			$this->UpdateSort($this->escuela); // escuela
			$this->UpdateSort($this->cargo); // cargo
			$this->UpdateSort($this->persona); // persona
			$this->UpdateSort($this->fecha_alta); // fecha_alta
			$this->UpdateSort($this->fecha_baja); // fecha_baja
			$this->UpdateSort($this->activo); // activo
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->id_servicio->setSort("");
				$this->escuela->setSort("");
				$this->cargo->setSort("");
				$this->persona->setSort("");
				$this->fecha_alta->setSort("");
				$this->fecha_baja->setSort("");
				$this->activo->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if (TRUE) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if (TRUE)
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->id_servicio->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "");
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fSERVICIOSlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fSERVICIOSlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fSERVICIOSlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fSERVICIOSlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($SERVICIOS_list)) $SERVICIOS_list = new cSERVICIOS_list();

// Page init
$SERVICIOS_list->Page_Init();

// Page main
$SERVICIOS_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$SERVICIOS_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fSERVICIOSlist = new ew_Form("fSERVICIOSlist", "list");
fSERVICIOSlist.FormKeyCountName = '<?php echo $SERVICIOS_list->FormKeyCountName ?>';

// Form_CustomValidate event
fSERVICIOSlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fSERVICIOSlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fSERVICIOSlist.Lists["x_escuela"] = {"LinkField":"x_CLAVE","Ajax":true,"AutoFill":false,"DisplayFields":["x_CLAVE","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"ESCUELA"};
fSERVICIOSlist.Lists["x_escuela"].Data = "<?php echo $SERVICIOS_list->escuela->LookupFilterQuery(FALSE, "list") ?>";
fSERVICIOSlist.Lists["x_cargo"] = {"LinkField":"x_id_cargo","Ajax":true,"AutoFill":false,"DisplayFields":["x_cargo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cargos"};
fSERVICIOSlist.Lists["x_cargo"].Data = "<?php echo $SERVICIOS_list->cargo->LookupFilterQuery(FALSE, "list") ?>";
fSERVICIOSlist.Lists["x_persona"] = {"LinkField":"x_id_persona","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"persona"};
fSERVICIOSlist.Lists["x_persona"].Data = "<?php echo $SERVICIOS_list->persona->LookupFilterQuery(FALSE, "list") ?>";
fSERVICIOSlist.Lists["x_activo"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fSERVICIOSlist.Lists["x_activo"].Options = <?php echo json_encode($SERVICIOS_list->activo->Options()) ?>;

// Form object for search
var CurrentSearchForm = fSERVICIOSlistsrch = new ew_Form("fSERVICIOSlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($SERVICIOS_list->TotalRecs > 0 && $SERVICIOS_list->ExportOptions->Visible()) { ?>
<?php $SERVICIOS_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($SERVICIOS_list->SearchOptions->Visible()) { ?>
<?php $SERVICIOS_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($SERVICIOS_list->FilterOptions->Visible()) { ?>
<?php $SERVICIOS_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $SERVICIOS_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($SERVICIOS_list->TotalRecs <= 0)
			$SERVICIOS_list->TotalRecs = $SERVICIOS->ListRecordCount();
	} else {
		if (!$SERVICIOS_list->Recordset && ($SERVICIOS_list->Recordset = $SERVICIOS_list->LoadRecordset()))
			$SERVICIOS_list->TotalRecs = $SERVICIOS_list->Recordset->RecordCount();
	}
	$SERVICIOS_list->StartRec = 1;
	if ($SERVICIOS_list->DisplayRecs <= 0 || ($SERVICIOS->Export <> "" && $SERVICIOS->ExportAll)) // Display all records
		$SERVICIOS_list->DisplayRecs = $SERVICIOS_list->TotalRecs;
	if (!($SERVICIOS->Export <> "" && $SERVICIOS->ExportAll))
		$SERVICIOS_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$SERVICIOS_list->Recordset = $SERVICIOS_list->LoadRecordset($SERVICIOS_list->StartRec-1, $SERVICIOS_list->DisplayRecs);

	// Set no record found message
	if ($SERVICIOS->CurrentAction == "" && $SERVICIOS_list->TotalRecs == 0) {
		if ($SERVICIOS_list->SearchWhere == "0=101")
			$SERVICIOS_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$SERVICIOS_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$SERVICIOS_list->RenderOtherOptions();
?>
<?php if ($SERVICIOS->Export == "" && $SERVICIOS->CurrentAction == "") { ?>
<form name="fSERVICIOSlistsrch" id="fSERVICIOSlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($SERVICIOS_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fSERVICIOSlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="SERVICIOS">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($SERVICIOS_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($SERVICIOS_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $SERVICIOS_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($SERVICIOS_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($SERVICIOS_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($SERVICIOS_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($SERVICIOS_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $SERVICIOS_list->ShowPageHeader(); ?>
<?php
$SERVICIOS_list->ShowMessage();
?>
<?php if ($SERVICIOS_list->TotalRecs > 0 || $SERVICIOS->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($SERVICIOS_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> SERVICIOS">
<form name="fSERVICIOSlist" id="fSERVICIOSlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($SERVICIOS_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $SERVICIOS_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="SERVICIOS">
<div id="gmp_SERVICIOS" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($SERVICIOS_list->TotalRecs > 0 || $SERVICIOS->CurrentAction == "gridedit") { ?>
<table id="tbl_SERVICIOSlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$SERVICIOS_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$SERVICIOS_list->RenderListOptions();

// Render list options (header, left)
$SERVICIOS_list->ListOptions->Render("header", "left");
?>
<?php if ($SERVICIOS->id_servicio->Visible) { // id_servicio ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->id_servicio) == "") { ?>
		<th data-name="id_servicio" class="<?php echo $SERVICIOS->id_servicio->HeaderCellClass() ?>"><div id="elh_SERVICIOS_id_servicio" class="SERVICIOS_id_servicio"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->id_servicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_servicio" class="<?php echo $SERVICIOS->id_servicio->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->id_servicio) ?>',1);"><div id="elh_SERVICIOS_id_servicio" class="SERVICIOS_id_servicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->id_servicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->id_servicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->id_servicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SERVICIOS->escuela->Visible) { // escuela ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->escuela) == "") { ?>
		<th data-name="escuela" class="<?php echo $SERVICIOS->escuela->HeaderCellClass() ?>"><div id="elh_SERVICIOS_escuela" class="SERVICIOS_escuela"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->escuela->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="escuela" class="<?php echo $SERVICIOS->escuela->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->escuela) ?>',1);"><div id="elh_SERVICIOS_escuela" class="SERVICIOS_escuela">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->escuela->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->escuela->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->escuela->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SERVICIOS->cargo->Visible) { // cargo ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->cargo) == "") { ?>
		<th data-name="cargo" class="<?php echo $SERVICIOS->cargo->HeaderCellClass() ?>"><div id="elh_SERVICIOS_cargo" class="SERVICIOS_cargo"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->cargo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cargo" class="<?php echo $SERVICIOS->cargo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->cargo) ?>',1);"><div id="elh_SERVICIOS_cargo" class="SERVICIOS_cargo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->cargo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->cargo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->cargo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SERVICIOS->persona->Visible) { // persona ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->persona) == "") { ?>
		<th data-name="persona" class="<?php echo $SERVICIOS->persona->HeaderCellClass() ?>"><div id="elh_SERVICIOS_persona" class="SERVICIOS_persona"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->persona->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="persona" class="<?php echo $SERVICIOS->persona->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->persona) ?>',1);"><div id="elh_SERVICIOS_persona" class="SERVICIOS_persona">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->persona->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->persona->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->persona->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SERVICIOS->fecha_alta->Visible) { // fecha_alta ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->fecha_alta) == "") { ?>
		<th data-name="fecha_alta" class="<?php echo $SERVICIOS->fecha_alta->HeaderCellClass() ?>"><div id="elh_SERVICIOS_fecha_alta" class="SERVICIOS_fecha_alta"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->fecha_alta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_alta" class="<?php echo $SERVICIOS->fecha_alta->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->fecha_alta) ?>',1);"><div id="elh_SERVICIOS_fecha_alta" class="SERVICIOS_fecha_alta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->fecha_alta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->fecha_alta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->fecha_alta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SERVICIOS->fecha_baja->Visible) { // fecha_baja ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->fecha_baja) == "") { ?>
		<th data-name="fecha_baja" class="<?php echo $SERVICIOS->fecha_baja->HeaderCellClass() ?>"><div id="elh_SERVICIOS_fecha_baja" class="SERVICIOS_fecha_baja"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->fecha_baja->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_baja" class="<?php echo $SERVICIOS->fecha_baja->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->fecha_baja) ?>',1);"><div id="elh_SERVICIOS_fecha_baja" class="SERVICIOS_fecha_baja">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->fecha_baja->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->fecha_baja->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->fecha_baja->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($SERVICIOS->activo->Visible) { // activo ?>
	<?php if ($SERVICIOS->SortUrl($SERVICIOS->activo) == "") { ?>
		<th data-name="activo" class="<?php echo $SERVICIOS->activo->HeaderCellClass() ?>"><div id="elh_SERVICIOS_activo" class="SERVICIOS_activo"><div class="ewTableHeaderCaption"><?php echo $SERVICIOS->activo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="activo" class="<?php echo $SERVICIOS->activo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $SERVICIOS->SortUrl($SERVICIOS->activo) ?>',1);"><div id="elh_SERVICIOS_activo" class="SERVICIOS_activo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $SERVICIOS->activo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($SERVICIOS->activo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($SERVICIOS->activo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$SERVICIOS_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($SERVICIOS->ExportAll && $SERVICIOS->Export <> "") {
	$SERVICIOS_list->StopRec = $SERVICIOS_list->TotalRecs;
} else {

	// Set the last record to display
	if ($SERVICIOS_list->TotalRecs > $SERVICIOS_list->StartRec + $SERVICIOS_list->DisplayRecs - 1)
		$SERVICIOS_list->StopRec = $SERVICIOS_list->StartRec + $SERVICIOS_list->DisplayRecs - 1;
	else
		$SERVICIOS_list->StopRec = $SERVICIOS_list->TotalRecs;
}
$SERVICIOS_list->RecCnt = $SERVICIOS_list->StartRec - 1;
if ($SERVICIOS_list->Recordset && !$SERVICIOS_list->Recordset->EOF) {
	$SERVICIOS_list->Recordset->MoveFirst();
	$bSelectLimit = $SERVICIOS_list->UseSelectLimit;
	if (!$bSelectLimit && $SERVICIOS_list->StartRec > 1)
		$SERVICIOS_list->Recordset->Move($SERVICIOS_list->StartRec - 1);
} elseif (!$SERVICIOS->AllowAddDeleteRow && $SERVICIOS_list->StopRec == 0) {
	$SERVICIOS_list->StopRec = $SERVICIOS->GridAddRowCount;
}

// Initialize aggregate
$SERVICIOS->RowType = EW_ROWTYPE_AGGREGATEINIT;
$SERVICIOS->ResetAttrs();
$SERVICIOS_list->RenderRow();
while ($SERVICIOS_list->RecCnt < $SERVICIOS_list->StopRec) {
	$SERVICIOS_list->RecCnt++;
	if (intval($SERVICIOS_list->RecCnt) >= intval($SERVICIOS_list->StartRec)) {
		$SERVICIOS_list->RowCnt++;

		// Set up key count
		$SERVICIOS_list->KeyCount = $SERVICIOS_list->RowIndex;

		// Init row class and style
		$SERVICIOS->ResetAttrs();
		$SERVICIOS->CssClass = "";
		if ($SERVICIOS->CurrentAction == "gridadd") {
		} else {
			$SERVICIOS_list->LoadRowValues($SERVICIOS_list->Recordset); // Load row values
		}
		$SERVICIOS->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$SERVICIOS->RowAttrs = array_merge($SERVICIOS->RowAttrs, array('data-rowindex'=>$SERVICIOS_list->RowCnt, 'id'=>'r' . $SERVICIOS_list->RowCnt . '_SERVICIOS', 'data-rowtype'=>$SERVICIOS->RowType));

		// Render row
		$SERVICIOS_list->RenderRow();

		// Render list options
		$SERVICIOS_list->RenderListOptions();
?>
	<tr<?php echo $SERVICIOS->RowAttributes() ?>>
<?php

// Render list options (body, left)
$SERVICIOS_list->ListOptions->Render("body", "left", $SERVICIOS_list->RowCnt);
?>
	<?php if ($SERVICIOS->id_servicio->Visible) { // id_servicio ?>
		<td data-name="id_servicio"<?php echo $SERVICIOS->id_servicio->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_id_servicio" class="SERVICIOS_id_servicio">
<span<?php echo $SERVICIOS->id_servicio->ViewAttributes() ?>>
<?php echo $SERVICIOS->id_servicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($SERVICIOS->escuela->Visible) { // escuela ?>
		<td data-name="escuela"<?php echo $SERVICIOS->escuela->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_escuela" class="SERVICIOS_escuela">
<span<?php echo $SERVICIOS->escuela->ViewAttributes() ?>>
<?php echo $SERVICIOS->escuela->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($SERVICIOS->cargo->Visible) { // cargo ?>
		<td data-name="cargo"<?php echo $SERVICIOS->cargo->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_cargo" class="SERVICIOS_cargo">
<span<?php echo $SERVICIOS->cargo->ViewAttributes() ?>>
<?php echo $SERVICIOS->cargo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($SERVICIOS->persona->Visible) { // persona ?>
		<td data-name="persona"<?php echo $SERVICIOS->persona->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_persona" class="SERVICIOS_persona">
<span<?php echo $SERVICIOS->persona->ViewAttributes() ?>>
<?php echo $SERVICIOS->persona->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($SERVICIOS->fecha_alta->Visible) { // fecha_alta ?>
		<td data-name="fecha_alta"<?php echo $SERVICIOS->fecha_alta->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_fecha_alta" class="SERVICIOS_fecha_alta">
<span<?php echo $SERVICIOS->fecha_alta->ViewAttributes() ?>>
<?php echo $SERVICIOS->fecha_alta->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($SERVICIOS->fecha_baja->Visible) { // fecha_baja ?>
		<td data-name="fecha_baja"<?php echo $SERVICIOS->fecha_baja->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_fecha_baja" class="SERVICIOS_fecha_baja">
<span<?php echo $SERVICIOS->fecha_baja->ViewAttributes() ?>>
<?php echo $SERVICIOS->fecha_baja->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($SERVICIOS->activo->Visible) { // activo ?>
		<td data-name="activo"<?php echo $SERVICIOS->activo->CellAttributes() ?>>
<span id="el<?php echo $SERVICIOS_list->RowCnt ?>_SERVICIOS_activo" class="SERVICIOS_activo">
<span<?php echo $SERVICIOS->activo->ViewAttributes() ?>>
<?php echo $SERVICIOS->activo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$SERVICIOS_list->ListOptions->Render("body", "right", $SERVICIOS_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($SERVICIOS->CurrentAction <> "gridadd")
		$SERVICIOS_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($SERVICIOS->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($SERVICIOS_list->Recordset)
	$SERVICIOS_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($SERVICIOS->CurrentAction <> "gridadd" && $SERVICIOS->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($SERVICIOS_list->Pager)) $SERVICIOS_list->Pager = new cPrevNextPager($SERVICIOS_list->StartRec, $SERVICIOS_list->DisplayRecs, $SERVICIOS_list->TotalRecs, $SERVICIOS_list->AutoHidePager) ?>
<?php if ($SERVICIOS_list->Pager->RecordCount > 0 && $SERVICIOS_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($SERVICIOS_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $SERVICIOS_list->PageUrl() ?>start=<?php echo $SERVICIOS_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($SERVICIOS_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $SERVICIOS_list->PageUrl() ?>start=<?php echo $SERVICIOS_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $SERVICIOS_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($SERVICIOS_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $SERVICIOS_list->PageUrl() ?>start=<?php echo $SERVICIOS_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($SERVICIOS_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $SERVICIOS_list->PageUrl() ?>start=<?php echo $SERVICIOS_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $SERVICIOS_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $SERVICIOS_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $SERVICIOS_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $SERVICIOS_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($SERVICIOS_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($SERVICIOS_list->TotalRecs == 0 && $SERVICIOS->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($SERVICIOS_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
fSERVICIOSlistsrch.FilterList = <?php echo $SERVICIOS_list->GetFilterList() ?>;
fSERVICIOSlistsrch.Init();
fSERVICIOSlist.Init();
</script>
<?php
$SERVICIOS_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$SERVICIOS_list->Page_Terminate();
?>