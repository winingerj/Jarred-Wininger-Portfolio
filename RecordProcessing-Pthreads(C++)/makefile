hw6: hw6.o SafeQueue.o
	g++ hw6.o SafeQueue.o -o hw6 -lpthread
hw6.o: hw6.cc SafeQueue.h
	g++ -c -g hw6.cc
SafeQueue.o: SafeQueue.cc SafeQueue.h
	g++ -c -g SafeQueue.cc
clean: 
	rm -f *.o
	rm -f hw6
