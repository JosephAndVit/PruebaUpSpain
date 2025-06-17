symfony new api --version="7.3.x-dev" --api

Doctrine por defecto tiene las siguientes configuraciones para poder leer las entidades (fichero config\packages\doctrine.yaml):
dir: '%kernel.project_dir%/src/Entity'
prefix: 'App\Entity'

Lo cambiamos por la siguiente:
dir: "%kernel.project_dir%/src/Domain"
prefix: 'App\Domain'

● Describa con palabras la estrategia que ha seguido.
