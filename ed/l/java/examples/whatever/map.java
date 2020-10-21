import java.util.Map;
import java.util.HashMap;

public class map
{
    public static void main(String[] args)
    {
       map1();
       simple();
    }

    public static void map1()
    {
        Map<String, String> map = new HashMap<>();
        map.put("f", "foo");
        map.put("b", "bar");
        map.put("x", "x");
        map.remove("x");
        map.forEach((k, v) -> System.out.printf("%s %s%n", k, v));
    }

    private static void simple()
    {
        Map<Integer,String> map = new HashMap<Integer,String>();
        map.put(1, "a");
        map.put(2, "b");
        map.put(3, "c");

        for (Map.Entry m:map.entrySet()) {
            System.out.print(m.getKey()+":"+m.getValue()+", ");
        }

        System.out.printf("\nby key: %d got: %s\n", 3, map.get(3));
    }
}