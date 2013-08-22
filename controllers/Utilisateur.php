<?php
	if (!class_exists('Utilisateur'))
	{
		class Utilisateur
		{
			public function	__construct()
			{
				parent::__construct('id');
				$this->m_class = 'Utilisateur';
				$this->db =  new Database();
			}

			public function __destruct()
			{
				parent::__destruct();
			}
			
			public function UpdateGoogleId($google_id, $autocommit = true)
			{
				if ($this->id === null)
					return false;
				$rslt = null;
				if ($this->google_id != substr($google_id, 0, 30))
				{
					$sql = 'UPDATE '.strtolower($this->m_class).' SET google_id = '.$google_id;
					$sql .= ' WHERE user_id = '.intval($this->id);
					$rslt = $this->db->query($sql);
					if ($rslt !== false)
					{
						if ($google_id !== null)
							$this->google_id = substr($google_id, 0, 30);
						else
							$this->google_id = null;
						$rslt = true;
					}
				}
				return $rslt;
			}
			
			public function UpdateTwitterId($twitter_id, $autocommit = true)
			{
				if ($this->id === null)
					return false;
				$rslt = null;
				if ($this->twitter_id != substr($twitter_id, 0, 30))
				{
					$sql = 'UPDATE '.strtolower($this->m_class).' SET twitter_id = '.$twitter_id;
					$sql .= ' WHERE id = '.intval($this->id);
					$rslt = $this->db->query($sql, $autocommit);
					if ($rslt !== false)
					{
						if ($twitter_id !== null)
							$this->twitter_id = substr($twitter_id, 0, 30);
						else
							$this->twitter_id = null;
						$rslt = true;
					}
				}
				return $rslt;
			}
			
			public static function	GetAccesGoogle($google_id)
			{
				$class = 'utilisateur';
				$sql = 'SELECT * FROM '.strtolower($class);
				$sql .= ' WHERE google_id = "'.$google_id.'"';
				$utilisateur = $this->db->query($sql, $class);
				if($utilisateur === false)
					return false;	
				return $utilisateur;
			}
			
			public static function	GetAccesTwitter($twitter_id)
			{
				$class = 'utilisateur';
				$sql = 'SELECT * FROM '.strtolower($class);
				$sql .= ' WHERE twitter_id = "'.$twitter_id.'"';
				$utilisateur = $this->db->query($sql, $class);
				if($utilisateur === false)
					return false;	
				return $utilisateur;
			}
		}
	}
?>