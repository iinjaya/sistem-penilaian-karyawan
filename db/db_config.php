<?php
class database extends PDO
{
	protected $dsn = 'mysql:host=localhost;dbname=db_spk';
	protected $dsu = 'root';
	protected $dsp = '';
	private $cmd = '';

	function __construct()
	{
		try {
			$this->db = new PDO($this->dsn, $this->dsu, $this->dsp, [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				// PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	//core query
	function select($column, $table)
	{
		$this->cmd = "select $column from $table";
		return $this;
	}

	function insert($t, $v)
	{
		$this->cmd = "insert into $t values($v)";
		return $this;
	}

	function update($t, $v)
	{
		$this->cmd = "update $t set $v";
		return $this;
	}

	function truncate($table)
	{
		$this->cmd = "truncate $table";
		return $this;
	}

	function delete($table)
	{
		$this->cmd = "delete from $table";
		return $this;
	}

	function alter($table, $action, $column, $format)
	{
		$this->cmd = "alter table $table $action $column $format";
		return $this;
	}
	//additional query
	function where($params)
	{
		$this->cmd .= " where $params";
		return $this;
	}

	function group_by($c)
	{
		$this->cmd .= " group by $c";
		return $this;
	}

	function order_by($c, $t)
	{
		$this->cmd .= " order by $c $t";
		return $this;
	}

	function like($c)
	{
		$this->cmd .= " like '%$c%'";
		return $this;
	}

	public function getFrom($query, $all = false)
	{
		$q = $this->db->prepare($query);
		$q->execute();
		return !$all ? $q->fetch() : $q->fetchAll();
	}
	//executable
	function get($isResults = true)
	{
		// echo $this->cmd;
		$q = $this->db->prepare($this->cmd);
		$q->execute();
		if ($isResults) return $q->fetchAll();
		return true;
	}
	function count()
	{
		//echo $this->cmd;
		$q = $this->db->prepare($this->cmd);
		$q->execute();
		return $q->rowCount();
	}

	//proses normalisasi
	function rumus($data, $kemampuan)
	{
		// echo $data, $kemampuan;
		foreach ($this->select('type', 'kriteria')->where("kriteria='$kemampuan'")->get() as $crt) {
			if ($crt[0] == 'Benefit') {
				foreach ($this->select("max($kemampuan)", 'hasil_tpa')->get() as $nm) {
					$nilai_max = $nm[0];
				}
				return $rumus = $data / $nilai_max;
			} else {
				foreach ($this->select("min($kemampuan)", 'hasil_tpa')->get() as $nm) {
					$nilai_min = $nm[0];
				}
				return $rumus = $nilai_min / $data;
			}
		}
	}

	//proses hasil 
	function bobot($kemampuan)
	{
		foreach ($this->select('bobot', 'kriteria')->where("kriteria='$kemampuan'")->get() as $bb) {
			return $bb[0];
		}
	}
}
$db = new database();
