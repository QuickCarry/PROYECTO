Posibles estados de un paquete:
En lote- Nada mas se ingresa un paquete se asigna el estado "En lote" porque cuando lo ingresamos le asignamos un paquete.
con este estado se empieza a tomar en cuenta el estado del lote.
En 2º QuickCarry - Es cuando el lote llego al almacen secundario de quickcarry y se desarmo el lote.
En camioneta - Es cuando se asigna el lote a una camioneta para que se dirija a su destino.
Entregado - Es cuando el camionero confirma que el paquete llego a su destino (La hubicación del cliente de Crecom).

Posibles estados de un Lote:
En QuickCarry - Es cuando el lote ya fue creado y aun no lo cerraron, osea que pueden seguir metiendo paquetes.
Cerrado - Es cuando el lote fue cerrado y ya no se pueden meter mas paquetes a ese lote.
En Camion - Es cuando se asigna a un camion para ir al almacen secundario. En este estado se empieza a tomar en cuenta el 
estado del trayecto que se guarda en la relacion "Conduce" que relaciona que chofer conduce que vehiculo.
En 2º QuickCarry- Es cuando el lote llego a la almacen secundaria de quickcarry pero aun no fue desarmado.

Posibles estados de un trayecto:
Detenido - Es cuando el camion aun esta detenido, siguen cargando lotes. El estado se cambia cuando el camionero deside empezar
el camino.
En rumbo - Es cuando el camion ya se esta dirijiendo al almacen secundario de quickcarry. O cuando en la camioneta se estan
entregando los paquetes a sus destinos.
En destino - Es cuando el camion ya llego al almacen secundario de quickcarry.