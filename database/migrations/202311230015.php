<?php

return new class
{
    public function up(): void
    {
        echo get_class($this).' method up'.PHP_EOL;
    }

    public function down(): void
    {
        echo get_class($this).' method down'.PHP_EOL;
    }
};
