<?php

    namespace Lunaris\Framework\ORM;

    use Lunaris\Framework\ORM\DB;

    class Model
    {
        protected $table;
        protected $primaryKey = 'id';

        // Get the shared QueryBuilder instance
        public static function query()
        {
            $instance = new static();
            return DB::getQueryBuilder()->table($instance->table);
        }

        public static function __callStatic($method, $arguments)
        {
            return self::query()->$method(...$arguments);
        }

        public static function find($id)
        {
            return self::query()->where((new static())->primaryKey, $id)->first();
        }

        public static function all()
        {
            return self::query()->get();
        }

        public static function save(array $data)
        {
            $instance = new static();
            $primaryKey = $instance->primaryKey;

            if (isset($data[$primaryKey])) {
                return self::query()->where($primaryKey, $data[$primaryKey])->update($data);
            } else {
                return self::query()->insert($data);
            }
        }

        public static function delete($id)
        {
            return self::query()->where((new static())->primaryKey, $id)->delete();
        }
    }
