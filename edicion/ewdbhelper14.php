<?php
if (!isset($EW_RELATIVE_PATH)) $EW_RELATIVE_PATH = "";
if (!isset($EW_ERROR_FN)) $EW_ERROR_FN = "ew_ErrorFn";
if (!defined("EW_USE_ADODB")) define("EW_USE_ADODB", TRUE, TRUE); // Use ADOdb
if (!defined("EW_USE_MYSQLI")) define("EW_USE_MYSQLI", extension_loaded("mysqli"), TRUE); // Use MySQLi
?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php
/**
 * PHPMaker 2018 database helper class
 */
if (!function_exists('DbHelper')) {

	function &DbHelper($dbid = "", $langfolder = "", $langid = "", $info = NULL) {
		$args = func_get_args();
		if (count($args) == 1 && is_array($args[0])) { // $info only
			$dbid = "";
			$langfolder = "";
			$langid = "";
			$info = $args[0];
		}
		$dbclass = "cTEST_db";
		$dbhelper = new $dbclass($langfolder, $langid, $info);
		return $dbhelper;
	}
}

class cTEST_db extends cDbHelper {

	// Database connection info
	// ADODB (Access/SQL Server)

	var $CodePage = 65001; // Code page

	// Database
	var $StartQuote = "[";
	var $EndQuote = "]";

	// Connect to database
	function &Connect($info = NULL) {
		if (!(strtolower(substr(PHP_OS, 0, 3)) === 'win')) // Non Windows platform
			die("Microsoft Access or SQL Server is supported on Windows server only.");
		$GLOBALS["ADODB_FETCH_MODE"] = ADODB_FETCH_BOTH;
		$GLOBALS["ADODB_COUNTRECS"] = FALSE;
		$conn = ADONewConnection('ado_access');
		$conn->debug = $this->Debug;
		if (!$info) {
			$info = array("provider" => "Provider=Microsoft.Jet.OLEDB.4.0", "relpath" => "", "dbname" => "test.mdb", "password" => ""); // ADO connection
		}
		if ($this->Debug)
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		if ($this->CodePage > 0)
			$conn->charPage = $this->CodePage;
		$relpath = @$info["relpath"];
		$dbname = @$info["dbname"];
		$provider = @$info["provider"];
		$password = @$info["password"];
		if ($relpath == "")
			$datasource = realpath($GLOBALS["EW_RELATIVE_PATH"] . $dbname);

		//elseif (substr($relpath, 0, 1) == ".") // Relative path starting with "." or ".." (relative to app root)
			//$datasource = ew_ServerMapPath($relpath . $dbname);

		elseif (substr($relpath, 0, 2) == "\\\\" || strpos($relpath, ":") !== FALSE) // Physical path
			$datasource = $relpath . $dbname;
		else // Relative to app root
			$datasource = ew_ServerMapPath($relpath) . $dbname;
		if ($password <> "")
			$connstr = $provider . ";Data Source=" . $datasource . ";Jet OLEDB:Database Password=" . $password . ";";
		elseif (strtoupper(substr($dbname, -6)) == ".ACCDB") // AccDb
			$connstr = $provider . ";Data Source=" . $datasource . ";Persist Security Info=False;";
		else
			$connstr = $provider . ";Data Source=" . $datasource . ";";
		$conn->Connect($connstr, FALSE, FALSE);
		$conn->raiseErrorFn = '';
		return $conn;
	}
}

// Abstract database helper class
abstract class cDbHelper {

	// Debug
	var $Debug = FALSE;

	// Language
	var $Language;

	// Connection
	var $Connection;

	// Constructor
	function __construct($langfolder = "", $langid = "", $info = NULL) {
		$args = func_get_args();
		if (count($args) == 1 && is_array($args[0])) { // $info only
			$langfolder = "";
			$langid = "";
			$info = $args[0];
		}

		// Debug
		if (defined("EW_DEBUG_ENABLED"))
			$this->Debug = EW_DEBUG_ENABLED;

		// Open connection
		if (!isset($this->Connection))
			$this->Connection = $this->Connect($info);

		// Set up language object
		if ($langfolder <> "")
			$this->Language = new cLanguage($langfolder, $langid);
		elseif (isset($GLOBALS["Language"]))
			$this->Language = &$GLOBALS["Language"];
	}

	// Quote name
	function QuotedName($Name) {
		$Name = str_replace($this->EndQuote, $this->EndQuote . $this->EndQuote, $Name);
		return $this->StartQuote . $Name . $this->EndQuote;
	}

	// Executes the query, and returns the row(s) as JSON, first row only by default
	function ExecuteJson($SQL, $FirstOnly = TRUE) {
		$rs = $this->LoadRecordset($SQL);
		if ($rs && !$rs->EOF && $rs->FieldCount() > 0) {
			$res = ($FirstOnly) ? $rs->fields : $rs->GetRows();
			$rs->Close();
			return json_encode($res);
		}
		return "false";
	}

	// Executes the query, and returns the row(s) as JSON array (no keys)
	function ExecuteJsonArray($SQL) {
		$rs = $this->LoadRecordset($SQL);
		if ($rs && !$rs->EOF && $rs->FieldCount() > 0) {
			$res = $rs->GetRows();
			$rs->Close();
			return ew_ArrayToJson($res);
		}
		return "false";
	}

	// Execute UPDATE, INSERT, or DELETE statements
	function Execute($SQL, $fn = NULL) {
		$conn = &$this->Connection;
		if ($this->Debug)
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($SQL);
		$conn->raiseErrorFn = '';
		if (is_callable($fn) && $rs) {
			while (!$rs->EOF) {
				$fn($rs->fields);
				$rs->MoveNext();
			}
			$rs->MoveFirst(); // For MySQL and PostgreSQL only
		}
		return $rs;
	}

	// Executes the query, and returns the first column of the first row
	function ExecuteScalar($SQL) {
		$res = FALSE;
		$rs = $this->LoadRecordset($SQL);
		if ($rs && !$rs->EOF && $rs->FieldCount() > 0) {
			$res = $rs->fields[0];
			$rs->Close();
		}
		return $res;
	}

	// Executes the query, and returns the first row
	function ExecuteRow($SQL) {
		$res = FALSE;
		$rs = $this->LoadRecordset($SQL);
		if ($rs && !$rs->EOF) {
			$res = $rs->fields;
			$rs->Close();
		}
		return $res;
	}

	// Load recordset
	function &LoadRecordset($SQL) {
		$conn = &$this->Connection;
		if ($this->Debug)
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($SQL);
		$conn->raiseErrorFn = '';
		return $rs;
	}

	// Table CSS class name
	var $TableClass = "table table-bordered ewDbTable";

	// Get result in HTML table
	// options: fieldcaption(bool|array), horizontal(bool), tablename(string|array), tableclass(string)
	function ExecuteHtml($SQL, $options = NULL) {
		$ar = is_array($options) ? $options : array();
		$horizontal = (array_key_exists("horizontal", $ar) && $ar["horizontal"]);
		$rs = $this->LoadRecordset($SQL);
		if (!$rs || $rs->EOF || $rs->FieldCount() < 1)
			return "";
		$html = "";
		$class = (array_key_exists("tableclass", $ar) && $ar["tableclass"]) ? $ar["tableclass"] : $this->TableClass;
		if ($rs->RecordCount() > 1 || $horizontal) { // Horizontal table
			$cnt = $rs->FieldCount();
			$html = "<table class=\"" . $class . "\">";
			$html .= "<thead><tr>";
			$row = &$rs->fields;
			foreach ($row as $key => $value) {
				if (!is_numeric($key))
					$html .= "<th>" . $this->GetFieldCaption($key, $ar) . "</th>";
			}
			$html .= "</tr></thead>";
			$html .= "<tbody>";
			$rowcnt = 0;
			while (!$rs->EOF) {
				$html .= "<tr>";
				$row = &$rs->fields;
				foreach ($row as $key => $value) {
					if (!is_numeric($key))
						$html .= "<td>" . $value . "</td>";
				}
				$html .= "</tr>";
				$rs->MoveNext();
			}
			$html .= "</tbody></table>";
		} else { // Single row, vertical table
			$html = "<table class=\"" . $class . "\"><tbody>";
			$row = &$rs->fields;
			foreach ($row as $key => $value) {
				if (!is_numeric($key)) {
					$html .= "<tr>";
					$html .= "<td>" . $this->GetFieldCaption($key, $ar) . "</td>";
					$html .= "<td>" . $value . "</td></tr>";
				}
			}
			$html .= "</tbody></table>";
		}
		return $html;
	}

	function GetFieldCaption($key, $ar) {
		$caption = "";
		if (!is_array($ar))
			return $key;
		$tablename = @$ar["tablename"];
		$usecaption = (array_key_exists("fieldcaption", $ar) && $ar["fieldcaption"]);
		if ($usecaption) {
			if (is_array($ar["fieldcaption"])) {
				$caption = @$ar["fieldcaption"][$key];
			} elseif (isset($this->Language)) {
				if (is_array($tablename)) {
					foreach ($tablename as $tbl) {
						$caption = @$this->Language->FieldPhrase($tbl, $key, "FldCaption");
						if ($caption <> "")
							break;
					}
				} elseif ($tablename <> "") {
					$caption = @$this->Language->FieldPhrase($tablename, $key, "FldCaption");
				}
			}
		}
		return ($caption <> "") ? $caption : $key;
	}
}

// Connection/Query error handler
if (!function_exists("ew_ErrorFn")) {

	// Connection/Query error handler
	function ew_ErrorFn($DbType, $ErrorType, $ErrorNo, $ErrorMsg, $Param1, $Param2, $Object) {
		if ($ErrorType == 'CONNECT') {
			if ($DbType == "ado_access" || $DbType == "ado_mssql") {
				$msg = "Failed to connect to database. Error: " . $ErrorMsg . " (" . $ErrorNo . ")";
			} else {
				$msg = "Failed to connect to $Param2 at $Param1. Error: " . $ErrorMsg . " (" . $ErrorNo . ")";
			}
		} elseif ($ErrorType == 'EXECUTE') {
			if (defined("EW_DEBUG_ENABLED") && EW_DEBUG_ENABLED) {
				$msg = "Failed to execute SQL: $Param1. Error: " . $ErrorMsg . " (" . $ErrorNo . ")";
			} else {
				$msg = "Failed to execute SQL. Error: " . $ErrorMsg . " (" . $ErrorNo . ")";
			}
		}
		if (function_exists("ew_AddMessage") && defined("EW_SESSION_FAILURE_MESSAGE"))
			ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $msg);
		else
			echo "<div class=\"alert alert-danger ewError\">" . $msg . "</div>";
	}
}
?>
