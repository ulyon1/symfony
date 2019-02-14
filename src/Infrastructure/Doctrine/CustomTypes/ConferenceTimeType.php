<?php

namespace Metinet\Infrastructure\Doctrine\CustomTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Metinet\Domain\Conferences\Time;

class ConferenceTimeType extends Type
{
    public const CONFERENCE_TIME = 'conference_time';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getTimeTypeDeclarationSQL($fieldDeclaration);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof Time) {

            return $value;
        }

        [$h, $m, $s] = explode(':', $value);

        return new Time($h, $m, $s);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {

            return $value;
        }

        if ($value instanceof Time) {

            return \DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                sprintf('1970-01-01 %s', $value)
            )->format($platform->getTimeFormatString());
        }
    }

    public function getName()
    {
        return self::CONFERENCE_TIME;
    }
}
