<?php

namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;

class Usuario extends Modelo
{
	protected int $usuario_id;
	protected int $rol_fk;
	protected string $email;
	protected string $password;
	protected ?string $nombre;
	protected ?string $apellido;

	protected string $table = "usuarios";
	protected string $primaryKey = "usuario_id";

    protected array $properties = ['usuario_id', 'rol_fk', 'nombre', 'apellido', 'password', 'email'];
	


  /**
    * Busca usuario según el correo.
    */	
	public function obtenerPorEmail(string $email): ?self
	{
		$db = DBConexion::getConexion();
		$query = "SELECT * FROM usuarios
				WHERE email = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$email]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
		$usuario = $stmt->fetch();
		return $usuario ? $usuario : null;
	}

	/**
	 * Crea un nuevo usuario.
	 */
	public function crearUsuario(array $data)
	{
		$db = DBConexion::getConexion();
		$db->beginTransaction();

        try{
			$query = "INSERT INTO usuarios (email, password, rol_fk, nombre, apellido)
				VALUES (:email, :password, :rol_fk, :nombre, :apellido)";
			$db->prepare($query)->execute([
				'email' => $data['email'],
				'password' => $data['password'],
				'rol_fk' => $data['rol_fk'],
				'nombre' => $data['nombre'],
				'apellido' => $data['apellido'],
			]);
			$db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
	}


	  /**
    * Restablece contraseña.
    */
	public function editarPassword(string $password)
	{
		$db = DBConexion::getConexion();
		$query = "UPDATE usuarios
				SET password = :password
				WHERE usuario_id = :usuario_id";
		$db->prepare($query)->execute([
			'password' => $password,
			'usuario_id' => $this->usuario_id,
		]);
	}

	// Setters & Getters
	public function getPassword(): string
	{
		return $this->password;
	}

	public function getUsuarioId(): int
	{
		return $this->usuario_id;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getNombreApellido(): string
	{
		return $this->nombre . " " . $this->apellido;
	}

	public function getRolFk(): int
	{
		return $this->rol_fk;
	}
}
