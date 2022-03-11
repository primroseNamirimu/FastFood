delimiter //
CREATE TRIGGER delete_audit BEFORE DELETE ON `orders` FOR EACH ROW
        BEGIN
        INSERT INTO order_audit_delete SET order_for = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.users.lastname`)
        ->groupBy(`users.firstname`)->get()'),
        deleted_by = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.food_order.order_made_by`)
        ->groupBy(`food_order.order_made_by`)->get()'),
        order_contents = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.food.name`)
        ->groupBy(`food.name`)->get()'),
        order_creation_date = ('DB::table(`food_order`)
        ->join(`food`,`food.id`,`=`,`food_order.food_id`)
        ->join(`orders`,`orders.id`,`=`,`food_order.order_id`)
        ->join(`users`,`users.id`,`=`,`orders.user_id`)
        ->select(`OLD.orders.created_at`)
        ->groupBy(`orders.created_at`)->get()'),
        deletion_time = NOW();
        END;//
        delimiter ;

        CREATE TABLE order_audit_delete (order_for varchar (225) NOT NULL, id bigint AUTO_INCREMENT NOT NULL PRIMARY KEY, deletion_time timestamp NOT NULL, order_creation_date timestamp NOT NULL, deleted_by varchar (225) NOT NULL, order_contents varchar (225) NOT NULL);
