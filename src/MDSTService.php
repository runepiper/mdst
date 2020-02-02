<?php
declare(strict_types=1);

namespace RP;

use \DateTime;
use Eluceo\iCal\Component\Alarm;
use Eluceo\iCal\Component\Calendar;
use Eluceo\iCal\Component\Event;

class MDSTService
{
    const FIRST_MDST = 2016;

    /**
     * @return array 100 years of MDST since 2016
     */
    public static function generateDates(): array
    {
        $dates = [];

        for ($i = 0; $i < 100; $i++) {
            $datetime = (new DateTime(self::FIRST_MDST . '-01-01'))
                ->modify('+' . $i . 'years')
                ->modify('first sunday of february');

            $dates[] = $datetime;
        }

        return $dates;
    }

    /**
     * @return string The iCal feed
     */
    public static function render(): string
    {
        $calendar = new Calendar('www.oderso.cool');
        $alarm = (new Alarm())
            ->setAction(Alarm::ACTION_DISPLAY)
            ->setDescription('Mach deine Scheiße!')
            ->setTrigger('-P1W');

        foreach (self::generateDates() as $date) {
            $calendarEvent = new Event();
            $calendarEvent
                ->setDtStart($date)
                ->setNoTime(true)
                ->setSummary('MDST – Mach deine Scheiße Tag')
                ->setDescription('Am ersten Sonntag im Februar ist es dann soweit. Keiner hat Bock, es ist scheiße kalt draußen, das Werkzeug is inner Weltgeschichte verteilt und doch muss alles fertig. Denn was heute liegen bleibt, bleibt 364 Tage liegen. Heute schaut die Welt auf unsere zwei linken Hände. Wir müssen ballern, stopfen, schleppen und vor allem eins: Kaschieren was der Mach deine Scheiße Tag hergibt. Am Ende wollen wir durch die Bude stapfen und kopfnickend, still in uns hinein applaudieren. Stolz auf die neuen Metallgegenstände an unseren Wänden zeigen und uns von unseren Mitbewohnern umgarnen lassen für unsere tolle Arbeit. Also ran die Scheiße. Es muss heute gemacht werden.')
                ->addComponent($alarm);

            $calendar->addComponent($calendarEvent);
        }

        return $calendar->render();
    }
}
