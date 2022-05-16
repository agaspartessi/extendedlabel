<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * extendedlabel module upgrade
 *
 * @package mod_extendedlabel
 * @copyright  2015 Cooperativa GENEOS (www.geneos.com.ar) - FLACSO
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This file keeps track of upgrades to
// the extendedlabel module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installation to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the methods of database_manager class
//
// Please do not forget to use upgrade_set_timeout()
// before any action that may take longer time to finish.

defined('MOODLE_INTERNAL') || die;

function xmldb_extendedlabel_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();


    // Moodle v2.2.0 release upgrade line
    // Put any upgrade step following this

    // Moodle v2.3.0 release upgrade line
    // Put any upgrade step following this


    // Moodle v2.4.0 release upgrade line
    // Put any upgrade step following this

    if ($oldversion < 2013021400) {
        // find all courses that contain extendedlabels and reset their cache
        $modid = $DB->get_field_sql("SELECT id FROM {modules} WHERE name=?",
                array('extendedlabel'));
        if ($modid) {
            $courses = $DB->get_fieldset_sql('SELECT DISTINCT course '.
                'FROM {course_modules} WHERE module=?', array($modid));
            foreach ($courses as $courseid) {
                rebuild_course_cache($courseid, true);
            }
        }

        // extendedlabel savepoint reached
        upgrade_mod_savepoint(true, 2013021400, 'extendedlabel');
    }

    // Moodle v2.5.0 release upgrade line.
    // Put any upgrade step following this.


    // Moodle v2.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Moodle v2.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Moodle v2.8.0 release upgrade line.
    // Put any upgrade step following this.

    // Moodle v2.9.0 release upgrade line.
    // Put any upgrade step following this.
    if ($oldversion < 2016010500) {
	$table = new xmldb_table('extendedlabel');
	$field = new xmldb_field('display_title', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'timemodified');

	if (!$dbman->field_exists($table, $field)) {
		$dbman->add_field($table, $field);
	}
        // extendedlabel savepoint reached
        upgrade_mod_savepoint(true, 2016010500, 'extendedlabel');
    }
/*
    if ($oldversion < 2016010500) {
       
	$table = new xmldb_table('extendedlabel');
        // extendedlabel savepoint reached
        upgrade_mod_savepoint(true, 2016010500, 'extendedlabel');
    }*/

    return true;
}


