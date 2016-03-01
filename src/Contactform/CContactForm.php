<?php

namespace Fnlive\Contactform;

/**
 * Contact Form, with storage and administration of submitted messages and visitors contact details.
 * Class for contactform model.
 */
class CContactForm extends \Anax\MVC\CDatabaseModel
{

    /**
     * Initialize model.
     *
     * @return array
     */
    public function init()
    {
        // $this->db->setVerbose();
        $this->db->dropTableIfExists('ccontactform')->execute();

        $this->db->createTable(
            'ccontactform',
            [
               'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
               'name' => ['varchar(80)'],
               'mail' => ['varchar(80)'],
               'web' => ['varchar(80)'],
               'subject' => ['varchar(80)'],
               'message' => ['varchar(1024)'],
               'created' => ['datetime'],
            ]
        )->execute();
        $this->db->insert(
            'ccontactform',
            ['name', 'mail', 'web', 'subject', 'message', 'created']
        );

        $now = time();

        $this->db->execute([
            'Fredrik Nilsson',
            'fn@live.se',
            'www.dbwebb.se',
            'Lorem ipsum',
            'Lorem ipsum dolor sit amet, ad nam graeci dissentias, te verear utroque per.
            Doming intellegat mea id, mel ei dicta iudico. Dicunt fabulas usu ad.
            Per nemore possim commune ut, eu probo dicta has. ',
            $now
        ]);

        $this->db->execute([
            'Joe Doe',
            'doe@dbwebb.se',
            'test.dbwebb.se',
            'Accusam',
            'Accusam eleifend qui ex. Has duis iuvaret salutatus id, dico illud porro ea mei,
            id oblique tibique eos. Ne eam meis equidem admodum, eos nisl maluisset id.
            Ancillae lucilius persecuti no sed.',
            $now
        ]);

        $this->db->execute([
            'Jane Doe',
            'doe@dbwebb.se',
            'jane.dbwebb.se',
            'Sea te',
            'Sea te vocibus dolores pertinax, quodsi insolens appellantur sit an, dicam definitionem sed ne.',
            $now
        ]);

    }
}
