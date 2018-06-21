<?php

// Global variable for table object
$SERVICIOS = NULL;

//
// Table class for SERVICIOS
//
class cSERVICIOS extends cTable {
	var $id_servicio;
	var $escuela;
	var $cargo;
	var $persona;
	var $fecha_alta;
	var $fecha_baja;
	var $activo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'SERVICIOS';
		$this->TableName = 'SERVICIOS';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "[SERVICIOS]";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id_servicio
		$this->id_servicio = new cField('SERVICIOS', 'SERVICIOS', 'x_id_servicio', 'id_servicio', '[id_servicio]', '[id_servicio]', 3, -1, FALSE, '[id_servicio]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_servicio->Sortable = TRUE; // Allow sort
		$this->id_servicio->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_servicio'] = &$this->id_servicio;

		// escuela
		$this->escuela = new cField('SERVICIOS', 'SERVICIOS', 'x_escuela', 'escuela', '[escuela]', '[escuela]', 202, -1, FALSE, '[escuela]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->escuela->Sortable = TRUE; // Allow sort
		$this->escuela->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->escuela->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['escuela'] = &$this->escuela;

		// cargo
		$this->cargo = new cField('SERVICIOS', 'SERVICIOS', 'x_cargo', 'cargo', '[cargo]', '[cargo]', 3, -1, FALSE, '[cargo]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cargo->Sortable = TRUE; // Allow sort
		$this->cargo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cargo->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->cargo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cargo'] = &$this->cargo;

		// persona
		$this->persona = new cField('SERVICIOS', 'SERVICIOS', 'x_persona', 'persona', '[persona]', '[persona]', 3, -1, FALSE, '[persona]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->persona->Sortable = TRUE; // Allow sort
		$this->persona->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->persona->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->persona->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['persona'] = &$this->persona;

		// fecha_alta
		$this->fecha_alta = new cField('SERVICIOS', 'SERVICIOS', 'x_fecha_alta', 'fecha_alta', '[fecha_alta]', ew_CastDateFieldForLike('[fecha_alta]', 0, "DB"), 7, 0, FALSE, '[fecha_alta]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_alta->Sortable = TRUE; // Allow sort
		$this->fecha_alta->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['fecha_alta'] = &$this->fecha_alta;

		// fecha_baja
		$this->fecha_baja = new cField('SERVICIOS', 'SERVICIOS', 'x_fecha_baja', 'fecha_baja', '[fecha_baja]', ew_CastDateFieldForLike('[fecha_baja]', 0, "DB"), 7, 0, FALSE, '[fecha_baja]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_baja->Sortable = TRUE; // Allow sort
		$this->fecha_baja->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['fecha_baja'] = &$this->fecha_baja;

		// activo
		$this->activo = new cField('SERVICIOS', 'SERVICIOS', 'x_activo', 'activo', '[activo]', '[activo]', 11, -1, FALSE, '[activo]', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->activo->Sortable = TRUE; // Allow sort
		$this->activo->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->activo->OptionCount = 2;
		$this->fields['activo'] = &$this->activo;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $this->LeftColumnClass);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "[SERVICIOS]";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$sSql = $this->ListSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id_servicio->setDbValue($conn->Insert_ID());
			$rs['id_servicio'] = $this->id_servicio->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id_servicio', $rs))
				ew_AddFilter($where, ew_QuotedName('id_servicio', $this->DBID) . '=' . ew_QuotedValue($rs['id_servicio'], $this->id_servicio->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "[id_servicio] = @id_servicio@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_servicio->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->id_servicio->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@id_servicio@", ew_AdjustSql($this->id_servicio->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "SERVICIOSlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "SERVICIOSview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "SERVICIOSedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "SERVICIOSadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "SERVICIOSlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("SERVICIOSview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("SERVICIOSview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "SERVICIOSadd.php?" . $this->UrlParm($parm);
		else
			$url = "SERVICIOSadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("SERVICIOSedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("SERVICIOSadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("SERVICIOSdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id_servicio:" . ew_VarToJson($this->id_servicio->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_servicio->CurrentValue)) {
			$sUrl .= "id_servicio=" . urlencode($this->id_servicio->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(141, 201, 203, 128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["id_servicio"]))
				$arKeys[] = $_POST["id_servicio"];
			elseif (isset($_GET["id_servicio"]))
				$arKeys[] = $_GET["id_servicio"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id_servicio->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id_servicio->setDbValue($rs->fields('id_servicio'));
		$this->escuela->setDbValue($rs->fields('escuela'));
		$this->cargo->setDbValue($rs->fields('cargo'));
		$this->persona->setDbValue($rs->fields('persona'));
		$this->fecha_alta->setDbValue($rs->fields('fecha_alta'));
		$this->fecha_baja->setDbValue($rs->fields('fecha_baja'));
		$this->activo->setDbValue((ew_ConvertToBool($rs->fields('activo'))) ? "1" : "0");
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id_servicio
		// escuela
		// cargo
		// persona
		// fecha_alta
		// fecha_baja
		// activo
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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_servicio
		$this->id_servicio->EditAttrs["class"] = "form-control";
		$this->id_servicio->EditCustomAttributes = "";
		$this->id_servicio->EditValue = $this->id_servicio->CurrentValue;
		$this->id_servicio->ViewCustomAttributes = "";

		// escuela
		$this->escuela->EditCustomAttributes = "";

		// cargo
		$this->cargo->EditCustomAttributes = "";

		// persona
		$this->persona->EditCustomAttributes = "";

		// fecha_alta
		$this->fecha_alta->EditAttrs["class"] = "form-control";
		$this->fecha_alta->EditCustomAttributes = "";
		$this->fecha_alta->EditValue = ew_FormatDateTime($this->fecha_alta->CurrentValue, 8);
		$this->fecha_alta->PlaceHolder = ew_RemoveHtml($this->fecha_alta->FldCaption());

		// fecha_baja
		$this->fecha_baja->EditAttrs["class"] = "form-control";
		$this->fecha_baja->EditCustomAttributes = "";
		$this->fecha_baja->EditValue = ew_FormatDateTime($this->fecha_baja->CurrentValue, 8);
		$this->fecha_baja->PlaceHolder = ew_RemoveHtml($this->fecha_baja->FldCaption());

		// activo
		$this->activo->EditCustomAttributes = "";
		$this->activo->EditValue = $this->activo->Options(FALSE);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->id_servicio->Exportable) $Doc->ExportCaption($this->id_servicio);
					if ($this->escuela->Exportable) $Doc->ExportCaption($this->escuela);
					if ($this->cargo->Exportable) $Doc->ExportCaption($this->cargo);
					if ($this->persona->Exportable) $Doc->ExportCaption($this->persona);
					if ($this->fecha_alta->Exportable) $Doc->ExportCaption($this->fecha_alta);
					if ($this->fecha_baja->Exportable) $Doc->ExportCaption($this->fecha_baja);
					if ($this->activo->Exportable) $Doc->ExportCaption($this->activo);
				} else {
					if ($this->id_servicio->Exportable) $Doc->ExportCaption($this->id_servicio);
					if ($this->escuela->Exportable) $Doc->ExportCaption($this->escuela);
					if ($this->cargo->Exportable) $Doc->ExportCaption($this->cargo);
					if ($this->persona->Exportable) $Doc->ExportCaption($this->persona);
					if ($this->fecha_alta->Exportable) $Doc->ExportCaption($this->fecha_alta);
					if ($this->fecha_baja->Exportable) $Doc->ExportCaption($this->fecha_baja);
					if ($this->activo->Exportable) $Doc->ExportCaption($this->activo);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->id_servicio->Exportable) $Doc->ExportField($this->id_servicio);
						if ($this->escuela->Exportable) $Doc->ExportField($this->escuela);
						if ($this->cargo->Exportable) $Doc->ExportField($this->cargo);
						if ($this->persona->Exportable) $Doc->ExportField($this->persona);
						if ($this->fecha_alta->Exportable) $Doc->ExportField($this->fecha_alta);
						if ($this->fecha_baja->Exportable) $Doc->ExportField($this->fecha_baja);
						if ($this->activo->Exportable) $Doc->ExportField($this->activo);
					} else {
						if ($this->id_servicio->Exportable) $Doc->ExportField($this->id_servicio);
						if ($this->escuela->Exportable) $Doc->ExportField($this->escuela);
						if ($this->cargo->Exportable) $Doc->ExportField($this->cargo);
						if ($this->persona->Exportable) $Doc->ExportField($this->persona);
						if ($this->fecha_alta->Exportable) $Doc->ExportField($this->fecha_alta);
						if ($this->fecha_baja->Exportable) $Doc->ExportField($this->fecha_baja);
						if ($this->activo->Exportable) $Doc->ExportField($this->activo);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
