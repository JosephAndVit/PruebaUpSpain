El proyecto lo he estructurado en una entidad raíz llamada Producto. Esta entidad encapsula los valores fundamentales de un producto, concretamente su Id, Nombre y Descripción, implementados como objetos de valor (Value Objects) para garantizar la inmutabilidad y validación de sus datos. Sirve de punto de entrada para el conjunto de datos relacionados, denominados Variantes. Cada variante tiene atributos como Talla, Color, Precio, Cantidad e Imagen, modelado en Value Object para validar y encapsular las reglas de negocio.
Relación de uno a muchos entre Producto y Variante.

Tiempo en realizar la prueba 3h 30 minutos.
