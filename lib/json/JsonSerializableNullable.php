<?php
/**
 * Class JsonSerializableNullable
 * classe abstrata para tranformar os objetos filhos em json sem remover os valores Null
 * @package     Php53Limitations
 * @subpackage  json
 * @author      Luiz Manhani <luiz.manhani@gmail.com.br>
 * @since       10-01-2018
 */

namespace Php53Limitations\json;

abstract class JsonSerializableNullable extends JsonSerializable
{
    /**
     * Método que executa a lógica de serialize
     * @return array|null
     */
    public function jsonSerialize()
    {
        return $this->mapArray($this->getArray());
    }
}