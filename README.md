
# IPC (Internal Process Communication) Component

/!\ UNIX only

Allows unix processes to share variables via the Shared Memory space.

## Usage

    $uidGenerator = new FtokUIDGenerator();
    $uid = $uidGenerator->generateUID(); // ex: 123123123

    // from process_1
    
    $memFactory = new ShmMemoryFactory();
    $memory = $memFactory->create($uid);
    
    $memory->set('var1', 'yolo');
    
    // from process_2
    
    $memFactory = new ShmMemoryFactory();
    $memory = $memFactory->create($uid);
    
    $var1 = $memory->get('var1');
    echo $var1; // 'yolo'
