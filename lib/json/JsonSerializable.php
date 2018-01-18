<?php
/**
 * Class JsonSerializable
 * classe abstrata para tranformar os objetos filhos em json
 * @package     Php53Limitations
 * @subpackage  json
 * @author      Luiz Manhani <luiz.manhani@gmail.com.br>
 * @since       10-01-2018
 */

namespace Php53Limitations\json;

abstract class JsonSerializable
{
    /**
     * M�todo que percorre o array e serializa se algum elemento for instancia de JsonSerializable
     * @param array $array
     * @return array
     */
    protected function mapArray(array $array)
    {
        $a = array_map(function ($value) {
            if ($value instanceof JsonSerializable) {
                return $value->jsonSerialize();
            } elseif (is_array($value)) {
                $newArray = $value;
                foreach ($value as $key => $val) {
                    if ($val instanceof JsonSerializable) {
                        $newArray[$key] = $val->jsonSerialize();
                    }
                }
                return $newArray;
            }
            return $value;
        }, $array);
        return $a;
    }
    
    /**
     * M�todo que executa a l�gica de serialize
     * @return array|null
     */
    public function jsonSerialize()
    {
        return $this->mapArray($this->clearNull());
    }
    
    /**
     * M�todo que filtra valores que est�o nulos
     * @return array|null
     */
    protected function clearNull()
    {
        return array_filter($this->getArray(), function ($value) {
            return $value !== null;
        }) ?: null;
    }
    
    /**
     * M�todo abstrato que retorna a estrutura de array como deve ir para o json
     * @return array
     */
    public abstract function getArray();
}