package main

import (
	"fmt"
)

func main() {
	// f1()
	f2()
}

func f2() {
	s := []string{"a", "b", "c"}
	fmt.Println("[f2]", s[:1]) // [f2] [a]
	fmt.Println("[f2]", s[1:]) // [f2] [b c]
}

func f1() {
	s1 := make([]int, 2) // length
	s1 = append(s1, 1)
	fmt.Println("[f1]", s1, len(s1), cap(s1)) // [f1] [0 0 1] 3 4

	s2 := make([]int, 0, 2) // length & capacity
	s2 = append(s2, 1)
	fmt.Println("[f1]", s2, len(s2), cap(s2)) // [f1] [1] 1 2
}
