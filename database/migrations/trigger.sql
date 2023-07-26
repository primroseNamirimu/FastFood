delimiter //
CREATE TRIGGER orders_update_trigger AFTER UPDATE ON food_order FOR EACH ROW
    BEGIN
        INSERT INTO changed_orders (order_id, original_food_id, new_food_id, order_for, reason, changed_by, order_created_at,created_at)
        VALUES (OLD.order_id, OLD.food_id, NEW.food_id, OLD.order_made_by, NEW.reason, NEW.changed_by, OLD.created_at,NOW());
        END;//


CREATE TRIGGER order_delete_audit BEFORE DELETE ON food_order FOR EACH ROW
        BEGIN
        INSERT INTO order_audit_delete VALUES (DB::table("food_order")
        ->join("food","food.id","=","food_order.food_id")
        ->join("orders","orders.id","=","food_order.order_id")
        ->join("users","users.id","=","orders.user_id")
        ->select("OLD.users.lastname")
        ->select("OLD.users.firstname")
        ->groupBy("users.lastname")->get(),
        food_id =OLD.food_id,
        order_id = OLD.order_id,
        reason = reason,
        order_created_at = OLD.created_at,
        deleted_by = deleted_by,
        deleted_on = NOW());
        END;//
        delimiter ;

CREATE TRIGGER orders_delete_trigger
    AFTER DELETE ON food_order
    FOR EACH ROW
    BEGIN INSERT
          INTO order_audit_delete (order_id, order_for, reason, food_id, order_created_at,deleted_by,deleted_on)
          VALUES (OLD.order_id, ,reason, OLD.food_id, OLD.created_at,deleted_by,NOW()); END;
//

CREATE TRIGGER orders_delete_trigger
    AFTER DELETE ON food_order
    FOR EACH ROW
BEGIN
    INSERT INTO audit_deletes (order_id, food_id, reason, order_created_at, deleted_by, deleted_on)
    VALUES  (order_id = OLD.order_id,
             food_id =OLD.food_id,
                 reason = OLD.reason,
                 order_created_at = OLD.created_at,
                 deleted_by =OLD.changed_by,
                 deleted_on = NOW());
END;//
delimiter ;
